<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Answer extends Model
{
    use SoftDeletes;
    /**
     * Answer belongs to Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() {
        return $this->belongsTo(Question::class);
    }
}
