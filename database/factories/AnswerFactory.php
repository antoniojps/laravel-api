<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    $questions = App\Question::pluck('id')->toArray();
    return [
        'body' => $faker->text($maxNbChars = 200),
        'question_id' => $faker->randomElement($questions)
    ];
});
