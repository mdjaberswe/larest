<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'poll_id' => $this->poll_id,
            'poll' => \App\Models\Poll::find($this->poll_id)->title,
            'question_title' => \Str::limit($this->title, 50),
            'question' => \Str::limit($this->question, 100),
        ];
    }
}
