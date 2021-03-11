<?php

namespace App\Http\Controllers\Api\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quiz\AnswerResource;
use App\Http\Resources\Quiz\GetQuizResource;
use App\Http\Resources\Quiz\QuestionResource;
use App\Http\Resources\Quiz\QuizResource;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * @param Request $request
     */
    public function postQuiz(Request $request)
    {
        try {
            $quiz = Quiz::create([
                'title' => $request->title,
            ]);

            return new QuizResource($quiz);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Quiz not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }

    public function postQuestion(Request $request)
    {
        try {
            $question = Question::create([
                'quiz_id' => $request->quiz_id,
                'title' => $request->title,
                'correct_id' => 0
            ]);

            return new QuestionResource($question);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Question not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }
    public function postAnswer(Request $request)
    {
        try {
            $answer = Answer::create([
                'question_id' => $request->question_id,
                'title' => $request->title
            ]);

            return new AnswerResource($answer);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Answer not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }

    public function getQuiz($id)
    {
        $quiz = Quiz::find($id);

        $questionId = request()->question_id ? request()->question_id : 0;
        $question = Question::getQuestion($quiz->id, $questionId);

        return response()->json([
            'quiz' => $quiz,
            'question' => $question,
        ]);
    }

    public function postResultAnswer(Request $request)
    {
        $answer = Answer::find($request->answer_id);

        $question = Question::where('quiz_id', $request->quiz_id)
            ->where('id', '>', $request->question_id)->first();

        if (!$question) {
            return false;
        }
        if ($answer->equalCorrect()->exists()) {
            return response()->json([
                'quiz_id'=>$request->quiz_id,
                'question'=>$request->question_id,
                'correct'=>true,
            ]);
        }

        return response()->json([
            'quiz_id'=>$request->quiz_id,
            'question'=>$request->question_id,
            'correct'=>false,
        ]);
    }
}
