<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JokeAPIController;

Route::group(['prefix'=>'api','as'=>'account.'], function(){
    Route::get('jokes', [JokeAPIController::class, 'getJokes']);
});
