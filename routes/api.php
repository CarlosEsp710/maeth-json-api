<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('v1')->routes(function ($api) {
    $api->resource('users')->relationships(function ($api) {
        $api->hasMany('articles')->except('replace', 'add', 'remove');
        $api->hasOne('nutritionistProfile')->except('replace');
        $api->hasOne('patientProfile')->except('replace');
    });

    $api->resource('nutritionists')->relationships(function ($api) {
        $api->hasOne('user');
        $api->hasMany('patients')->except('replace', 'add', 'remove');
    });

    $api->resource('patients')->relationships(function ($api) {
        $api->hasOne('user');
        $api->hasOne('nutritionist');
    });

    $api->resource('categories')->relationships(function ($api) {
        $api->hasMany('articles')->except('replace', 'add', 'remove');
    });

    $api->resource('articles')->relationships(function ($api) {
        $api->hasOne('author');
        $api->hasOne('category');
    });

    Route::post('login', [LoginController::class, 'login'])
        ->name('login')
        ->middleware('guest:sanctum');

    Route::post('logout', [LoginController::class, 'logout'])
        ->middleware('auth:sanctum')
        ->name('logout');

    Route::post('register', [RegisterController::class, 'register'])
        ->middleware('guest:sanctum')
        ->name('register');

    Route::get('user', UserController::class)
        ->middleware('auth:sanctum')
        ->name('user');
});
