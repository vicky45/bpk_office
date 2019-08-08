<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Event extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'idEvent' => $this->idEvent,
            'code_event' => $this->code_event,
            'name_event' => $this->name_event,
            'date_event' => $this->date_event,
            'time_event' => $this->time_event,
            'status_event' => $this->status_event,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
