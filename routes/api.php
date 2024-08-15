<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// /*
    // |--------------------------------------------------------------------------
    // | API Routes
    // |--------------------------------------------------------------------------
    // |
    // | Here is where you can register API routes for your application. These
    // | routes are loaded by the RouteServiceProvider within a group which
    // | is assigned the "api" middleware group. Enjoy building your API!
    // |
    // */

    // Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
// });


Route::get('/chart/reviews_chart', 'MyClinic\Api\ApiController@reviews_analysis_chart');
Route::get('/chart/reviews_leaved_chart', 'MyClinic\Api\ApiController@reviews_leaved_analysis_chart');
Route::get('/chart/last_reviews_chart', 'MyClinic\Api\ApiController@last_reviews_analysis_chart');
