<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('groups', 'GroupsController@index')->name('groups.index');
Route::get('groups/{id}', 'GroupsController@show')->name('groups.show');

Route::get('{year}', 'DashboardController@index')->name('dashboard');
Route::get('{year}/ratings', 'RatingController@index')->name('ratings.index');
Route::get('{year}/ratings/pdf/{formNumber}/{suffix?}', 'Pdf\RatingController')->name('pdf.show');
Route::get('{year}/ratings/{formNumber}/{suffix?}', 'RatingController@show')->name('ratings.show');

Route::get('{year}/scores', 'ScoreController@index')->name('scores.index');
Route::get('{year}/scores/hiketimes', 'ScoreController@calculateHikeScores')->name('hike.calculate.times');
Route::get('{year}/scores/theme', 'ScoreController@calculateThemeScores')->name('hike.calculate.thema');

Route::get('{year}/scores/{formNumber}/{suffix?}', 'ScoreController@show')->name('scores.show');
Route::get('{year}/results', 'ResultController@index')->name('result.index');
Route::get('{year}/results/pdf', 'ResultController@pdf')->name('result.pdf');
Route::get('{year}/import', 'Import\ImportController@import')->name('import.index');

Route::post('{year}/scores/{formNumber}/{suffix?}', 'ScoreController@store')->name('scores.store');

Route::get('{year}/stats/ratio-category', 'Stats\RatingCategoryController@ratio')->name('stats.rating-category.ratio');
Route::get('{year}/stats/category/{ratingId}', 'Stats\RatingCategoryController@scoresByRating')->name('stats.category.scores');
Route::get('/stats/group/{groupId}/category/{ratingCategoryId}', 'Stats\GroupController@ratingByCategoryAndGroup')->name('stats.group.category');


