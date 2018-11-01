<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionAnswersRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $question = $this->additional['questions'];

        return [
            'data'  => AnswerIdentifierResource::collection($this->collection),
            'links' => [
                'self'    => route('questions.relationships.answers', ['question' => $question->id]),
                'related' => route('questions.answers', ['question' => $question->id]),
            ],
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
