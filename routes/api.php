<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

JsonApi::register('v1')->routes(function ($api) {
    $api->resource('years', [
        'has-many' => ['teams', 'scores', 'ratings'],
    ]);
//     $api->resource('teams', [
//         'has-one' => ['year', 'group'],
//     ]);
//     $api->resource('groups', [
//         'has-many' => ['teams'],
//     ]);
//     $api->resource('ratings', [
//         'has-many' => ['scores', 'criteria'],
//         'has-one' => ['rating-categories', 'year'],
//     ]);
//     $api->resource('rating-categories', [
//         'has-many' => ['ratings'],
//     ]);
//     $api->resource('scores', [
//         'has-one' => ['group', 'team'],
//     ]);
});
