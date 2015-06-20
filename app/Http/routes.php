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
