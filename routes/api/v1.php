<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Index as UserIndex;
use App\Http\Controllers\Api\User\Create as UserCreate;
use App\Http\Controllers\Api\User\Show as UserShow;
use App\Http\Controllers\Api\User\Update as UserUpdate;

Route::middleware('auth:sanctum')->prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndex::class)->name('index');
    Route::get('/{user:id}', UserShow::class)->name('show');
    Route::post('/', UserCreate::class)->name('create');
    Route::put('/{user:id}', UserUpdate::class)->name('update');
});
