<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Question extends ResourceCollection
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
            'idQuestion' => $this->idQuestion,
            'Speaker_idSpeaker' => $this->Speaker_idSpeaker,
            'User_NIP' => $this->User_NIP,
            'Admin_idAdmin' => $this->Admin_idAdmin,
            'Event_idEvent' => $this->Event_idEvent,
            'question' => $this->question,
            'answer' => $this->answer,
            'reaction_like' => $this->reaction_like,
            'reaction_dislike' => $this->reaction_dislike,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
