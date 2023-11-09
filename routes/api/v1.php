<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Index as UserIndex;
use App\Http\Controllers\Api\User\Create as UserCreate;
use App\Http\Controllers\Api\User\Show as UserShow;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::middleware('auth:sanctum')->prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndex::class)->name('index');
    Route::post('/', UserCreate::class)->name('create');
    Route::post('/{user:id}', UserShow::class)->name('show');
});
