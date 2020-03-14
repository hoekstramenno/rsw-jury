<?php

Route::get('/', 'DashboardController@welcome')->name('welcome');

Route::get('groups', 'GroupsController@index')->name('groups.index');
Route::get('groups/{id}', 'GroupsController@show')->name('groups.show');

Route::get('change-year/{year}', 'YearController@change')->name('year.change');

Route::get('dashboard/{year}', 'DashboardController@index')->name('dashboard');
Route::get('{year}/teams', 'TeamController@index')->name('teams.index');
Route::get('{year}/teams/new', 'TeamController@create')->name('teams.create');
Route::post('{year}/teams', 'TeamController@store')->name('teams.store');

Route::get('{year}/teams/{id}', 'TeamController@show')->name('teams.show');

Route::get('{year}/ratings', 'RatingController@index')->name('ratings.index');
Route::get('{year}/ratings/pdf/{formNumber}/{suffix?}', 'Pdf\RatingController')->name('pdf.show');
Route::get('{year}/ratings/{formNumber}/{suffix?}', 'RatingController@show')->name('ratings.show');

Route::get('{year}/scores', 'ScoreController@index')->name('scores.index');
Route::get('{year}/scores/hike-times', 'HikeController@edit')->name('hike.times.edit');
Route::post('scores/hike-times/{teamId}', 'HikeController@store')->name('hike.times.store');
Route::get('{year}/scores/theme', 'ScoreController@calculateThemeScores')->name('score.calculate.theme');

Route::get('{year}/scores/{formNumber}/{suffix?}', 'ScoreController@show')->name('scores.show');
Route::get('{year}/results', 'ResultController@index')->name('result.index');
Route::get('{year}/results/pdf', 'ResultController@pdf')->name('result.pdf');
Route::get('{year}/import', 'Import\ImportController@import')->name('import.index');

Route::post('{year}/scores/{formNumber}/{suffix?}', 'ScoreController@store')->name('scores.store');

Route::get('{year}/stats/ratio-category', 'Stats\RatingCategoryController@ratio')->name('stats.rating-category.ratio');
Route::get('{year}/stats/category/{ratingId}', 'Stats\RatingCategoryController@scoresByRating')->name('stats.category.scores');
