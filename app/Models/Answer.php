<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id','title'
    ];


    public function equalCorrect()
    {
        return $this->hasOne('App\Models\Question','correct_id','id');
    }

}
