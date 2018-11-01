<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Resources\AnswersResource;

class QuestionRelationshipController extends Controller
{
    public function answers(Question $question)
    {
        return new AnswersResource($question->answers);
    }
}