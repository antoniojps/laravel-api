<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use QuestionAsnwersRelationshipResource;

class QuestionRelationshipResource extends JsonResource
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
            'answers' => (new QuestionAnswersRelationshipResource($this->answers))->additional(['questions' => $this]),
        ];
    }
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('questions.index'),
            ],
        ];
    }
}
