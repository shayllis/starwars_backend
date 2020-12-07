<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\StatisticsController;

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


// Route::controller('view', 'ViewController');

// /api/view/people/1
Route::get('/view/{category}', [EventsController::class, 'view']);
Route::get('/search/{category}', [EventsController::class, 'search']);
Route::get('/statistics/terms', [StatisticsController::class, 'terms']);
Route::get('/statistics/items', [StatisticsController::class, 'items']);
