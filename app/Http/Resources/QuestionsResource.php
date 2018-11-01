<?php

namespace App\Http\Resources;

use App\Answer;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionsResource extends ResourceCollection
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
            'data' => QuestionResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        $answers = $this->collection->flatMap(
            function ($question) {
                return $question->answers;
            }
        );
        return [
            'links'    => [
                'self' => route('answers.index'),
            ],
        ];
    }

}
