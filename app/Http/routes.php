<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);
Route::get('announcement/{id?}', 'Today\AnnouncementController@index');
Route::get('story/{id?}', 'Today\StoryController@index');
Route::get('news/{id?}', 'Today\StoryController@index');

Route::get('calendar/{year?}/{month?}/{day?}', 'Today\CalendarController@index');


Route::get('article/{id?}', 'Today\MagazineController@article');
Route::get('magazine/article/{id?}', 'Today\MagazineController@article');
Route::get('magazine/issue/{year?}/{season?}', 'Today\MagazineController@issue');
Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');

Route::get('hub', 'MainController@index');

Route::group(['prefix' => 'api'], function() {
    Route::get('active-categories/{year?}/{month?}/{day?}','Api\CategoriesController@activeCategories');

    Route::get('calendar/month/{year?}/{month?}/{day?}','Api\CalendarController@eventsInMonth');
    Route::get('calendar/events/{year?}/{month?}/{day?}','Api\CalendarController@eventsByDay');

});
// Route::get('/', function () {
//     return view('welcome');
// });
