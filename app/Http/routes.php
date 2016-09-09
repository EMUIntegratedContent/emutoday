<?php


use Emutoday\MiniCalendar;
use Emutoday\Building;
use Emutoday\Event;
use Emutoday\Category;
use Emutoday\Tag;

use Illuminate\Support\Facades\Input;
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

Route::group(['prefix' => 'api'], function() {
    Route::get('active-categories/{year?}/{month?}/{day?}','Api\CategoriesController@activeCategories');

    Route::get('calendar/month/{year?}/{month?}/{day?}','Api\CalendarController@eventsInMonth');
    Route::get('calendar/events/{year?}/{month?}/{day?}','Api\CalendarController@eventsByDay');


    /**
     * List of Buildings for EventForm
     */
    Route::get('buildinglist', function() {
        $text = Input::get('q');
        return Building::likeSearch('name', $text)->select('name')->get();
        //return Building::ofMapType('illustrated')->get();
    });
    /**
     * List of Categories for EventForm
     */
    Route::get('categorylist', function() {
        $text = Input::get('q');
        return Category::likeSearch('category', $text)->select('category', 'id as value')->get();
        //return Building::ofMapType('illustrated')->get();
    });
    /**
     * List of MiniCalendars for EventForm
     */
    Route::get('minicalslist', function() {
        return MiniCalendar::select('calendar', 'id as value')->get();
    });
});

// Route::group(['middleware' => ['web']], function() {

    // Route::controller('auth/password', 'Auth\PasswordController', [
    //         'getEmail' => 'auth.password.email',
    //         'getReset' => 'auth.password.reset'
    //     ]);
    //
    // Route::controller('auth', 'Auth\AuthController', [
    //     'getLogin' => 'auth.login',
    //     'getLogout' => 'auth.logout'
    // ]);

    Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);

    Route::get('announcement/form', 'Today\AnnouncementController@announcementForm');
    Route::get('announcement/{id?}', 'Today\AnnouncementController@index');
    Route::get('story/{id?}', 'Today\StoryController@index');
    Route::get('news/{id?}', 'Today\StoryController@index');
    Route::get('calendar/event/form', 'Today\CalendarController@eventForm');
    Route::get('calendar/{year?}/{month?}/{day?}', 'Today\CalendarController@index');


    Route::get('article/{id?}', 'Today\MagazineController@article');
    Route::get('magazine/article/{id?}', 'Today\MagazineController@article');
    Route::get('magazine/issue/{year?}/{season?}', 'Today\MagazineController@issue');
    Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');

    Route::get('hub', 'MainController@index');

    Route::group(['prefix' => 'admin' ], function()
    {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
    });

// });
// Route::get('/', function () {
//     return view('welcome');
// });

Route::auth();
