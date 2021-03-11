<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
       'quiz_id','title','correct_id'
    ];

    public static function getQuestion($quizId,$questionId=0)
    {
        if($questionId == 0){

            return self::where('quiz_id',$quizId)->first();
        }else{

            return self::where('id','>',$questionId)->where('quiz_id',$quizId)->first();
        }

    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
