<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\PollController;
use \App\Http\Controllers\API\QuestionController;
use \App\Http\Controllers\API\FilesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Polls
Route::apiResource('polls', PollController::class);
Route::get('polls/{poll}/questions', [PollController::class, 'questions']);
Route::any('errors', [PollController::class, 'errors']);

// Questions
Route::apiResource('questions', QuestionController::class);

// Files
Route::get('files/download', [FilesController::class, 'download']);
Route::post('files/store', [FilesController::class, 'store']);

