<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Participant;
use App\Models\Speaker;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiEventController extends Controller
{
    public function index(): ResourceCollection
    {
        return EventResource::collection(Cache::remember('events', Carbon::now()->endOfDay()->diffInSeconds(), function () {
            return Event::all();
        }));
    }

    public function show(Event $event): EventResource
    {
        return new EventResource($event->loadMissing(['participants', 'speakers', 'eventCategories']));
    }

    public function store(StoreEventRequest $request): Response
    {
        try {
            $event = Event::create($request->validated());
            $eventResource = new EventResource($event);

            return response()->json($eventResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to create event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateEventRequest $request, Event $event): Response
    {
        try {
            $event->update($request->validated());
            $event = $event->load(['participants', 'speakers', 'eventCategories']);
            $eventResource = new EventResource($event);

            return response()->json($eventResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to update event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Event $event): Response
    {
        DB::beginTransaction();

        try {
            $event->delete();

            DB::commit();

            return response()->json([
                'message' => 'Event deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function storeParticipant(Event $event, Participant $participant): Response
    {
        try {
            if (!$event->participants->contains($participant->id)) {
                $event->participants()->attach($participant->id);

                return response()->json(['message' => 'Participant successfully added to the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Participant already exists on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to add participant on the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function storeSpeaker(Event $event, Speaker $speaker): Response
    {
        try {
            if (!$event->speakers->contains($speaker->id)) {
                $event->speakers()->attach($speaker->id);

                return response()->json(['message' => 'Speaker successfully added to the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Speaker already exists on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to add speaker on the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function storeEventCategory(Event $event, EventCategory $eventCategory): Response
    {
        try {
            if (!$event->eventCategories->contains($eventCategory->id)) {
                $event->eventCategories()->attach($eventCategory->id);

                return response()->json(['message' => 'Event category successfully added to the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Event category already exists on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to add event category on the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroyParticipant(Event $event, Participant $participant): Response
    {
        try {
            if ($event->participants->contains($participant->id)) {
                $event->participants()->detach($participant->id);

                return response()->json(['message' => 'Participant successfully deleted from the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Participant does not exist on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to deleted participant from the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroySpeaker(Event $event, Speaker $speaker): Response
    {
        try {
            if ($event->speakers->contains($speaker->id)) {
                $event->speakers()->detach($speaker->id);

                return response()->json(['message' => 'Speaker successfully deleted from the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Speaker does not exist on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to add speaker from the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroyEventCategory(Event $event, EventCategory $eventCategory): Response
    {
        try {
            if ($event->eventCategories->contains($eventCategory->id)) {
                $event->eventCategories()->detach($eventCategory->id);

                return response()->json(['message' => 'Event category successfully deleted from the event'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Event category does not exist on the event'], Response::HTTP_CONFLICT);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to add event category from the event'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
