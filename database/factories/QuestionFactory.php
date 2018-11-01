<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {

    $interrogatedText = substr($faker->text($maxNbChars = 200), 0, -1) . '?';

    return [
        'title' => $interrogatedText,
        'description' => $faker->text($maxNbChars = 500)
    ];
});
