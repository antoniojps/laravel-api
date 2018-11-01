<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('questions', 'QuestionController');
Route::apiResource('answers', 'AnswerController');

Route::get(
    'questions/{question}/relationships/answers',
    [
        'uses' => 'QuestionRelationshipController@answers',
        'as' => 'questions.relationships.answers',
    ]
);

Route::get(
    'questions/{question}/answers',
    [
        'uses' => 'QuestionRelationshipController@answers',
        'as' => 'questions.answers',
    ]
);