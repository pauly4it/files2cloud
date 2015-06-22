<?php

// Auth Routes
Route::get('/', [
    'uses' => 'AuthController@index',
    'as' => 'auth'
]);
Route::post('auth/login', [
    'uses' => 'AuthController@login',
    'as' => 'auth.login'
]);
Route::post('auth/register', [
    'uses' => 'AuthController@create',
    'as' => 'auth.register'
]);

// Main app route
Route::get('users/{username}/home', [
    'uses' => 'FileController@index',
    'as' => 'home'
]);

// API routes
// CSRF check necessary
//Route::group(['middleware' => 'csrf'], function()
//{
    // File Routes
    Route::get('users/{username}/files', 'FileController@getFiles');
    Route::post('users/{username}/files', 'FileController@store');
//});
