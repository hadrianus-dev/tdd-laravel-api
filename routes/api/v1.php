<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::prefix('user')->as('user')->group(function(){
    Route::get('/', function () {
        return [];
    })->name('index');
});
