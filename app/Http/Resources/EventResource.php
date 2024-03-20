<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date_time' => Carbon::parse($this->date_time)->format('Y-m-d H:i:s'),
            'location' => $this->location,
            'participants' => ParticipantResource::collection($this->whenLoaded('participants')),
            'speakers' => SpeakerResource::collection($this->whenLoaded('speakers')),
            'event_categories' => EventCategoryResource::collection($this->whenLoaded('eventCategories')),
        ];
    }
}
