<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'questions',
            'id'            => (string)$this->id,
            'attributes'    => [
                'title' => $this->title,
                'description' => $this->description,
            ],
            'relationships' => new QuestionRelationshipResource($this),
            'links' => [
                'self' => route('questions.show', [
                    'question' => $this->id
                ]),
            ],
        ];
    }
}
