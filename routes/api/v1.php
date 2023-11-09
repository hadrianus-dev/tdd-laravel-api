<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Index as UserIndex;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndex::class)->name('index');
});
