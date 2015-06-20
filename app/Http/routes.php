<?php

Route::get('/', function () {
    return view('welcome');
});
// Auth Routes
Route::post('auth/login', [
    'uses' => 'AuthController@login',
    'as' => 'auth.login'
]);
Route::post('auth/register', [
    'uses' => 'AuthController@create',
    'as' => 'auth.register'
]);
// API routes
// CSRF check necessary
//Route::group(['middleware' => 'csrf'], function()
//{
    // File Routes
    Route::get('users/{username}/files', 'FileController@index');
    Route::post('users/{username}/files', 'FileController@store');
//});
