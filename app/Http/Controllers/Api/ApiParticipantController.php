<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiParticipantController extends Controller
{
    public function index(): ResourceCollection
    {
        return ParticipantResource::collection(Cache::remember('participants', Carbon::now()->endOfDay()->diffInSeconds(), function () {
            return Participant::orderBy('id', 'asc')->get();
        }));
    }

    public function show(Participant $participant): ParticipantResource
    {
        return new ParticipantResource($participant->loadMissing(['events']));
    }

    public function store(StoreParticipantRequest $request): Response
    {
        try {
            $participant = Participant::create($request->validated());
            $participantResource = new ParticipantResource($participant);

            return response()->json($participantResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to create participant'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateParticipantRequest $request, Participant $participant): Response
    {
        try {
            $participant->update($request->validated());
            $participant = $participant->load(['events']);
            $participantResource = new ParticipantResource($participant);

            return response()->json($participantResource, Response::HTTP_OK);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Failed to update participant'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Participant $participant): Response
    {
        DB::beginTransaction();

        try {
            $participant->delete();

            DB::commit();

            return response()->json([
                'message' => 'Participant deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete participant'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
