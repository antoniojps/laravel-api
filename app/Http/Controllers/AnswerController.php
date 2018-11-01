<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswersResource;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;
use Symfony\Component\HttpFoundation\Response;


class AnswerController extends Controller
{
    /**
     * Display a listing of paginated answers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AnswersResource(Answer::paginate());
    }

    /**
     * Store a newly created answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerStoreRequest $request)
    {
        try {
            $answer = new Answer();
            $answer->body = $request->body;
            $answer->question_id = $request->question_id;

            $question = Question::findOrFail($request->question_id);
            $question->answers()->save($answer);

            QuestionResource::withoutWrapping();
            return new QuestionResource($question);
        } catch (\Exception $e) {
            return response([
                'errors' => $e->getMessage(),
                'status' => 404,
            ], 404);
        }
    }

    /**
     * Display the specified answer.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        AnswerResource::withoutWrapping();
        return new AnswerResource($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerUpdateRequest $request, Answer $answer)
    {
        try {
        $validatedData = $request->validated();

        $answer->update($validatedData);

        AnswerResource::withoutWrapping();
        return new AnswerResource($answer);
        } catch (\Exception $e) {
            return response([
                'errors' => $e->getMessage(),
                'status' => 404,
            ], 404);
        }
    }

    /**
     * Remove an answer.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        AnswerResource::withoutWrapping();
        return new AnswerResource($answer);
    }
}
