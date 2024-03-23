<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventCategoryRequest;
use App\Http\Requests\UpdateEventCategoryRequest;
use App\Http\Resources\EventCategoryResource;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiEventCategoryController extends Controller
{
    public function index()
    {
        return EventCategoryResource::collection(Cache::remember('eventCategories', Carbon::now()->endOfDay()->diffInSeconds(), function () {
            return EventCategory::all();
        }));
    }

    public function show(EventCategory $eventCategory)
    {
        return new EventCategoryResource($eventCategory->loadMissing(['events']));
    }

    public function store(StoreEventCategoryRequest $request)
    {
        try {
            $eventCategory = EventCategory::create($request->validated());
            $eventCategoryResource = new EventCategoryResource($eventCategory);

            return response()->json($eventCategoryResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to create event category'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateEventCategoryRequest $request, EventCategory $eventCategory)
    {
        try {
            $eventCategory->update($request->validated());
            $eventCategory = $eventCategory->load('events');
            $eventCategoryResource = new EventCategoryResource($eventCategory);

            return response()->json($eventCategoryResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to update event category'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(EventCategory $eventCategory)
    {
        DB::beginTransaction();

        try {
            $eventCategory->delete();

            DB::commit();

            return response()->json([
                'message' => 'Event category deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete event category'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
