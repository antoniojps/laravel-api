<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * One Question has many Answers
     * https://laravel.com/docs/5.7/eloquent-relationships#updating-belongs-to-relationships
     */
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
