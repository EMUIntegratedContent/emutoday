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
Route::get('article/{id?}', 'Today\MagazineController@article');
Route::get('magazine/article/{id?}', 'Today\MagazineController@article');
Route::get('magazine/issue/{year?}/{season?}', 'Today\MagazineController@issue');
Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');

Route::get('hub', 'MainController@index');


// Route::get('/', function () {
//     return view('welcome');
// });
