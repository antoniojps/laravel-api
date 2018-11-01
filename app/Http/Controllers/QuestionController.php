<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Requests\StoreQuestion;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new QuestionsResource(Question::with(['answers'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        $validatedData = $request->validated();

        $question = Question::create($validatedData);

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestion $request, Question $question)
    {
        $validatedData = $request->validated();

        $question->update($validatedData);

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }
}
