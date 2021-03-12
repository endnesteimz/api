<?php

use App\Http\Controllers\Api\Auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', 'App\Http\Controllers\Api\Auth\LoginController@store')->name('api.auth.login');
    Route::post('/register', 'App\Http\Controllers\Api\Auth\RegisterController@store')->name('api.auth.register');
    Route::post('/forgot', 'App\Http\Controllers\Api\Auth\ForgotPasswordController@store')->name('api.auth.forgot.password');


    Route::group(['middleware' => 'jwt.auth'], function() {



        Route::post('/change', 'App\Http\Controllers\Api\Auth\ChangePasswordController@store')->name('api.auth.change.password');
        Route::get('/logout', 'App\Http\Controllers\Api\Auth\LogoutController@get')->name('api.auth.logout');
        Route::get('/me', 'App\Http\Controllers\Api\Auth\UserController@show')->name('api.auth.user');

        Route::group(['middleware' => 'jwt.refresh'], function() {
            Route::get('/refresh', 'App\Http\Controllers\Api\Auth\RefreshTokenController@get')->name('api.auth.refresh');
        });

        Route::get('/protected', function() {
			return response()->json([
				'message' => 'Access to this item is only for authenticated user. Provide a token in your request!'
			]);
		});
    });
});

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::get('/user', [UserController::class, 'fetch']);
    Route::post('/user', [UserController::class, 'updateProfile']);
});

Route::group(['middleware' => 'api','prefix' => 'quiz'], function ($router) {
    Route::post('add_quiz','App\Http\Controllers\Api\Quiz\QuizController@postQuiz')->middleware('jwt.auth');
    Route::post('add_question','App\Http\Controllers\Api\Quiz\QuizController@postQuestion')->middleware('jwt.auth');
    Route::post('add_answer','App\Http\Controllers\Api\Quiz\QuizController@postAnswer')->middleware('jwt.auth');
    Route::get('get_quiz/{id}','App\Http\Controllers\Api\Quiz\QuizController@getQuiz')->middleware('jwt.auth');
    Route::post('post_result','App\Http\Controllers\Api\Quiz\QuizController@postResultAnswer')->middleware('jwt.auth');

});

Route::group(['middleware' => 'api','prefix' => 'categories'], function ($router) {
    Route::get('tutorials/{id}','App\Http\Controllers\Api\Categories\CategoriesController@tutorialList')->middleware('jwt.auth');;

});

Route::apiResource('categories', 'App\Http\Controllers\Api\Categories\CategoriesController')->middleware('jwt.auth');
Route::apiResource('media', 'App\Http\Controllers\Api\Media\MediaController')->middleware('jwt.auth');
Route::apiResource('tutorial', 'App\Http\Controllers\Api\Media\TutorialsController')->middleware('jwt.auth');
Route::apiResource('comments', 'App\Http\Controllers\Api\Media\CommentController')->middleware('jwt.auth');
Route::apiResource('modalmessage', 'App\Http\Controllers\ModalMessageController')->middleware(['jwt.auth','throttle:4,10']);

Route::group(['middleware' => 'api','prefix' => 'comments'], function ($router) {
    Route::get('showcomment/{id}','App\Http\Controllers\Api\Media\CommentController@showComment')->middleware('jwt.auth');

});

