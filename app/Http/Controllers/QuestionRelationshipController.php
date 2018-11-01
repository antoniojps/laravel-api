<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Resources\AnswersResource;

class QuestionRelationshipController extends Controller
{
    /**
     * Query answers by question
     *
     * Get all answers for a specific question
     *
     * @queryParam question int required The questions id. Example: 20
     *
     * @response {
            "data": [
                {
                    "type": "answers",
                    "id": "27",
                    "attributes": {
                        "body": "Natus officiis voluptatem enim corporis soluta maxime. Dicta velit beatae aspernatur. Aut sit dignissimos quaerat porro asperiores. Eveniet rem dolore quia sit."
                    },
                    "links": {
                        "self": "http://laravel.test/api/answers/27"
                    }
                },
                {
                    "type": "answers",
                    "id": "36",
                    "attributes": {
                        "body": "Reprehenderit quidem et sit ad ipsam. Est deserunt quo et quia incidunt iusto. Quia ut rerum iusto inventore natus doloremque et alias. Quis et ut natus."
                    },
                    "links": {
                        "self": "http://laravel.test/api/answers/36"
                    }
                },
                {
                    "type": "answers",
                    "id": "52",
                    "attributes": {
                        "body": "Excepturi ipsa mollitia est facilis. Sed reprehenderit expedita impedit ducimus ratione id enim. Ducimus porro aut vel voluptas qui porro. Velit non tenetur quae necessitatibus quibusdam quis."
                    },
                    "links": {
                        "self": "http://laravel.test/api/answers/52"
                    }
                }
            ],
            "links": {
                "self": "http://laravel.test/api/answers"
            }
        }
    */
    public function answers(Question $question)
    {
        return new AnswersResource($question->answers);
    }
}