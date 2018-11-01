<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'type' => 'answers',
            'id' => (string)$this->id,
            'attributes' => [
                'body' => $this->body,
            ],
            'links' => [
                'self' => route('answers.show', [
                    'answer' => $this->id
                ]),
            ]
        ];
    }
}
