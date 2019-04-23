<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/application/quiz');
});

Route::get('/application', function () {
    return view('access');
});

Route::group(['prefix' => 'application'], function() {
    Auth::routes();
    Route::get('/quiz', 'QuizController@index')->name('quiz');
    Route::match(['get', 'post'], '/quiz/run/{id}', 'QuizController@run')->where('id', '[0-9]+')->name('quiz_run');
    Route::get('/quiz/result', 'QuizController@result')->name('quiz_result');
    Route::post('/logout', 'QuizController@logout')->name('logout');
    Route::delete('quiz/destroy', 'QuizController@destroy')->name('quiz_destroy');
});

Route::resource('application', 'QuizController');