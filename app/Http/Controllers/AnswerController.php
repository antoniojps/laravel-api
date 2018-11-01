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
     * Query answers
     *
     * Get listing of answers paginated
     *
     */
    public function index()
    {
        return new AnswersResource(Answer::paginate());
    }

    /**
     * Add answer
     *
     * Add a new answer to a question
     *
     * @bodyParam question_id int required The question id. Example: 21
     * @bodyParam body string Answer. Example: Its not working because you forgot the question_id parameter!
     *
     * @response {
        "type": "questions",
        "id": "24",
        "attributes": {
            "title": "Será que está tudo a funcionar?",
            "description": "Descriçao atualizada"
        },
        "relationships": {
            "answers": {
                "data": [
                    {
                        "type": "answers",
                        "id": "67",
                        "body": "Sim, parece estár tudo a funcionar!"
                    },
                    {
                        "type": "answers",
                        "id": "68",
                        "body": "Em principio sim!"
                    }
                ],
                "links": {
                    "self": "http://laravel.test/api/questions/24/relationships/answers",
                    "related": "http://laravel.test/api/questions/24/answers"
                }
            }
        },
        "links": {
            "self": "http://laravel.test/api/questions/24"
        }
    }
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
     * Query answer
     *
     * Query an answer by Id
     *
     *
     * @queryParam answer int required The answer id. Example: 30
    */
    public function show(Answer $answer)
    {
        AnswerResource::withoutWrapping();
        return new AnswerResource($answer);
    }

    /**
     * Update answer
     *
     * Update an answer by Id
     *
     *
     * @queryParam answer int required The answers id. Example: 30
     * @bodyParam body string Answer. Example: Its not working because you forgot the question_id parameter!
     * @response {
        "type": "answers",
        "id": "20",
        "attributes": {
            "body": "Esqueceste-te do ponto e virgula!"
        },
        "links": {
            "self": "http://laravel.test/api/answers/20"
        }
    }
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
     * Delete answer
     *
     * Soft deletes the answer adding a "deleted_at", the deleted answer is sent.
     *
     * @queryParam answer int required The answers id. Example: 30
     * @response {
        "type": "answers",
        "id": "30",
        "attributes": {
            "body": "Afinal, não sei bem!"
        },
        "links": {
            "self": "http://laravel.test/api/answers/68"
        }
    }
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        AnswerResource::withoutWrapping();
        return new AnswerResource($answer);
    }
}
