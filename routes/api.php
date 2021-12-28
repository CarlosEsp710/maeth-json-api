<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\API\UserController;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('v1')->routes(function ($api) {
    $api->resource('users')->relationships(function ($api) {
        $api->hasMany('articles')->except('replace', 'add', 'remove');
        $api->hasOne('nutritionistProfile')->except('replace');
        $api->hasOne('patientProfile')->except('replace');
    });

    $api->resource('nutritionists')
        ->only('create', 'update')
        ->relationships(function ($api) {
            $api->hasOne('user')->except('replace');
            $api->hasMany('patients')->except('replace', 'add', 'remove');
        });

    $api->resource('patients')
        ->only('create', 'update')
        ->relationships(function ($api) {
            $api->hasOne('user')->except('replace');
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
        ->middleware('guest:sanctum')
        ->name('login');

    Route::post('logout', [LoginController::class, 'logout'])
        ->middleware('auth:sanctum')
        ->name('logout');

    Route::post('register', [RegisterController::class, 'register'])
        ->middleware('guest:sanctum')
        ->name('register');

    Route::get('user', UserController::class)
        ->middleware('auth:sanctum')
        ->name('user');

    Route::get('roles', [RoleController::class, 'index'])
        ->middleware('auth:sanctum')
        ->name('roles.index');

    Route::get('roles/{role}', [RoleController::class, 'read'])
        ->middleware('auth:sanctum')
        ->name('roles.read');

    Route::get('permissions', [RoleController::class, 'permissions'])
        ->middleware('auth:sanctum')
        ->name('permissions.index');

    Route::post('roles', [RoleController::class, 'create'])
        ->middleware('auth:sanctum')
        ->name('roles.create');

    Route::patch('roles/{role}', [RoleController::class, 'update'])
        ->middleware('auth:sanctum')
        ->name('roles.update');

    Route::delete('roles/{role}', [RoleController::class, 'delete'])
        ->middleware('auth:sanctum')
        ->name('roles.delete');

    // Route::apiResource('roles', RoleController::class)
    //     ->middleware('auth:sanctum');
});
