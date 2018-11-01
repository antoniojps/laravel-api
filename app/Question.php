<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Question extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * One Question has many Answers
     * https://laravel.com/docs/5.7/eloquent-relationships#updating-belongs-to-relationships
     */
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
