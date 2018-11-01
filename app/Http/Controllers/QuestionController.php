<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Query questions
     *
     * Get questions paginated alongside answers
     *
     */

    public function index()
    {
        return new QuestionsResource(Question::with(['answers'])->paginate());
    }

    /**
     * Add question
     *
     * Add a new question
     *
     * @bodyParam title string required The question. Example: Why is this not working?
     * @bodyParam description string Question explanation. Example: Ive done this and that this is still not working, what am I doint wrong?
     *
     * @response {
        "type": "questions",
        "id": "21",
        "attributes": {
            "title": "Será que está tudo a funcionar?",
            "description": "Descriçao aqui"
        },
        "relationships": {
            "answers": {
                "data": [],
                "links": {
                    "self": "http://laravel.test/api/questions/21/relationships/answers",
                    "related": "http://laravel.test/api/questions/21/answers"
                }
            }
        },
        "links": {
            "self": "http://laravel.test/api/questions/21"
        }
    }
    */
    public function store(QuestionRequest $request)
    {
        $validatedData = $request->validated();

        $question = Question::create($validatedData);

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Query question
     *
     * Query a question by Id
     *
     *
     * @queryParam question int required The questions id. Example: 10
    */
    public function show(Question $question)
    {
        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Update question
     *
     * Update a question by Id
     *
     *
     * @queryParam question int required The questions id. Example: 20
     * @bodyParam title string required The question. Example: Why is this not working?
     * @bodyParam description string Question explanation. Example: Ive done this and that this is still not working, what am I doint wrong?
     * @response {
        "type": "questions",
        "id": "21",
        "attributes": {
            "title": "Será que está tudo a funcionar?",
            "description": "Descriçao atualizada"
        },
        "relationships": {
            "answers": {
                "data": [],
                "links": {
                    "self": "http://laravel.test/api/questions/21/relationships/answers",
                    "related": "http://laravel.test/api/questions/21/answers"
                }
            }
        },
        "links": {
            "self": "http://laravel.test/api/questions/21"
        }
    }
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $validatedData = $request->validated();

        $question->update($validatedData);

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }

    /**
     * Delete question
     *
     * Soft deletes the question adding a "deleted_at" value
     *
     * @queryParam question int required The questions id. Example: 20
     * @response {
        "type": "questions",
        "id": "21",
        "attributes": {
            "title": "Será que está tudo a funcionar?",
            "description": "Descriçao atualizada"
        },
        "relationships": {
            "answers": {
                "data": [],
                "links": {
                    "self": "http://laravel.test/api/questions/21/relationships/answers",
                    "related": "http://laravel.test/api/questions/21/answers"
                }
            }
        },
        "links": {
            "self": "http://laravel.test/api/questions/21"
        }
    }
     */
    public function destroy(Question $question)
    {
        $question->delete();

        QuestionResource::withoutWrapping();
        return new QuestionResource($question);
    }
}
