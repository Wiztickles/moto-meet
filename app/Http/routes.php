<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::auth();

Route::get('/home', 'HomeController@index');


// Meets Controller
Route::get('meet', 'MeetController@index');
Route::get('meet/past', 'MeetController@pastMeet');
Route::get('meet/create', 'MeetController@create');
Route::post('meet/create', 'MeetController@store');
Route::get('meet/edit/{id}', 'MeetController@edit');
Route::post('meet/edit/{id}', 'MeetController@update');
Route::get('meet/delete/{id}', 'MeetController@deleteMeet');
Route::post('meet/delete/{id}', 'MeetController@delete');

Route::get('meet/{id}', 'MeetController@show');

Route::get('comment/edit/{id}', 'CommentController@edit');
Route::post('comment/edit/{id}', 'CommentController@update');
Route::get('comment/delete/{id}', 'CommentController@deleteComment');
Route::post('comment/delete/{id}', 'CommentController@delete');

Route::post('meet/{id}/comment', 'CommentController@store');

Route::post('attend', 'AttendController@attending');
Route::post('not_attending', 'AttendController@notAttending');

Route::get('profile/{id}', 'HomeController@profile');
Route::get('profile/edit/{id}', 'HomeController@profileEdit');
Route::post('profile/edit/{id}', 'HomeController@update');
Route::get('rules', 'HomeController@rules');
