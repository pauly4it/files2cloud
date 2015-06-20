<?php

// login view, no remember session yet
Route::get('/', function () {
    return view('login');
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

// Main app route
Route::get('users/{username}/home', ['as' => 'home', function($username) {

    // return view with username
    // also return CSRF token so that React can use that for API calls
    return view('home', ['username' => $username])
        ->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));
}]);

// API routes
// CSRF check necessary
//Route::group(['middleware' => 'csrf'], function()
//{
    // File Routes
    Route::get('users/{username}/files', 'FileController@index');
    Route::post('users/{username}/files', 'FileController@store');
//});
