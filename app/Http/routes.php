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
    Route::get('taglist', function() {

        return Tag::select('name', 'id as value')->get();
    });


    Route::get('announcement/queueload', ['as' => 'api_announcement_queueload', 'uses' => 'Api\AnnouncementController@queueLoad']);
    Route::patch('announcement/archiveitem/{id}', ['as' => 'api_announcement_archiveitem', 'uses' => 'Api\AnnouncementController@archiveItem']);
    Route::patch('announcement/updateitem/{id}', ['as' => 'api_announcement_updateitem', 'uses' =>'Api\AnnouncementController@updateItem']);
    Route::resource('announcement', 'Api\AnnouncementController');



    Route::get('event/queueload', ['as' => 'api.event.queueload', 'uses' => 'Api\EventController@queueLoad']);
    Route::patch('event/updateitem/{event}', 'Api\EventController@updateItem');
    Route::post('event/addmediafile/{event}', 'Api\EventController@addMediaFile');
    Route::resource('event', 'Api\EventController');

    Route::get('story/queueload/{stype}', ['as'=> 'api_story_queueload', 'uses'=> 'Api\StoryController@queueLoad']);



    Route::patch('story/updateitem/{id}', ['as' => 'api_story_updateitem', 'uses' => 'Api\StoryController@updateItem']);

    Route::patch('story/archiveitem/{id}', ['as' => 'api_story_archiveitem', 'uses' => 'Api\StoryController@archiveItem']);

    Route::resource('story', 'Api\StoryController');


    Route::get('page/chartload', ['as' => 'api_page_chartload', 'uses' => 'Api\PageController@chartLoad']);

    Route::get('page/queueload', ['as' => 'api.page.queueload', 'uses' => 'Api\PageController@queueLoad']);

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
    Route::get('search','MainController@search' );
    Route::auth();
    //watch out for match anything ROUTES
    Route::group(['prefix' => 'preview' ], function()
    {
        Route::get('page/{page}/', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
        Route::get('magazine/{magazine}/', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);

        Route::get('magazine/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);

        Route::get('story/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
        Route::get('{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);


    });

    Route::group(['prefix' => 'admin' ], function()
    {


        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
        Route::get('search', ['as' => 'admin.search', 'uses' => 'Admin\DashboardController@search']);

        Route::get('announcement/queue', ['as' => 'admin.announcement.queue', 'uses' => 'Admin\AnnouncementController@queue']);
        Route::get('announcement/form', ['as' => 'admin.announcement.form', 'uses' => 'Admin\AnnouncementController@form']);
        Route::resource('announcement', 'Admin\AnnouncementController');

        Route::get('event/queue', ['as' => 'admin.event.queue', 'uses' => 'Admin\EventController@queue']);
        Route::get('event/form', ['as' => 'admin.event.form', 'uses' => 'Admin\EventController@form']);
        Route::resource('event', 'Admin\EventController');



        Route::post('story/{stype}/{story}/addNewStoryImage',['as' => 'admin_storyimage_add_new_storyimage', 'uses' => 'Admin\StoryImageController@addNewStoryImage']);
        Route::get('storyimage/{storyimage}/confirm', ['as' => 'admin_storyimage_confirm', 'uses' => 'Admin\StoryImageController@confirm']);

        Route::patch('storyimage/{storyimage}/update',['as' => 'admin_storyimage_update', 'uses' => 'Admin\StoryImageController@update']);
        Route::post('storyimage//{storyimage}/delete', ['as' => 'admin_storyimage_destroy', 'uses' => 'Admin\StoryImageController@destroy'] );

        Route::resource('storyimage', 'Admin\StoryImageController');

        Route::post('promotestory', ['as'=> 'admin_promotestory', 'uses'=> 'Admin\StoryController@promoteStory']);
        Route::put('story/{id}/updatefrompreview', ['as'=> 'admin_story_update_from_preview', 'uses'=> 'Admin\StoryController@updateFromPreview']);

        Route::get('magazine/article/queuearticle', ['as'=> 'admin_magazine_article_queue', 'uses'=> 'Admin\StoryController@queueArticle']);

        Route::get('story/queue', ['as' => 'admin_story_queue', 'uses' => 'Admin\StoryController@queue']);

        Route::get('story/{stype}/queueall', ['as' => 'admin_storytype_queueall', 'uses' => 'Admin\StoryController@queue']);
        Route::get('story/{stype}/queuenews', ['as' => 'admin_storytype_queuenews', 'uses' => 'Admin\StoryController@queueNews']);
        Route::get('story/{stype}/queuenews', ['as' => 'admin_storytype_queue', 'uses' => 'Admin\StoryController@queueType']);

        Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryTypeController@articleSetup']);
        Route::get('story/{stype}/setup', ['as' => 'admin_storytype_setup', 'uses' => 'Admin\StoryTypeController@storyTypeSetUp']);


        Route::get('magazine/{stype}/{story}/edit', ['as' => 'admin_magazine_article_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);

        // Route::get('news/story/{story}/edit', ['as' => 'admin_news_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);

        Route::get('story/{stype}/{story}/edit', ['as' => 'admin_storytype_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);


        Route::get('page/form', ['as' => 'admin_page_form', 'uses' => 'Admin\PageController@form']);
        Route::get('page/{page}/edit', ['as' => 'admin_page_edit', 'uses' => 'Admin\PageController@edit']);
        Route::post('page/delete', ['as' => 'admin_page_delete', 'uses' => 'Admin\PageController@delete'] );
        Route::resource('page', 'Admin\PageController');

        Route::get('magazine/form', ['as' => 'admin_magazine_form', 'uses' => 'Admin\MagazineController@form']);
        Route::get('magazine/{magazine}/edit', ['as' => 'admin_magazine_edit', 'uses' => 'Admin\MagazineController@edit']);
        Route::post('magazine/delete', ['as' => 'admin_magazine_delete', 'uses' => 'Admin\MagazineController@delete'] );

        Route::post('magazine/{magazine}/addCoverImage', ['as' => 'store_magazine_cover', 'uses' => 'Admin\MagazineController@addCoverImage']);
        Route::put('magazine/{mediafile}/updateCoverImage/', ['as' => 'update_magazine_cover', 'uses' => 'Admin\MagazineController@updateCoverImage']);
        Route::resource('magazine', 'Admin\MagazineController');

        Route::post('user/{user}/addMediafileUser', ['as' => 'store_mediafile_user', 'uses' => 'Admin\MediafileController@addMediafileUser']);
        Route::post('user/{user}/updateMediafileUser', ['as' => 'update_mediafile_user', 'uses' => 'Admin\MediafileController@updateMediafileUser']);
        Route::delete('user/{user}/removeMediafileUser', ['as' => 'remove_mediafile_user', 'uses' => 'Admin\MediafileController@removeMediafileUser']);

        Route::get('user/{user}/edit', ['as' => 'admin_user_edit', 'uses' => 'Admin\UserController@edit']);
        Route::get('user/{user}/confirm', ['as' => 'admin_user_confirm', 'uses' => 'Admin\UserController@confirm']);
        Route::resource('user', 'Admin\UserController');



    });

    Route::group(['prefix' => 'preview' ], function()
    {
        Route::get('page/{page}/', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
        Route::get('magazine/{magazine}/', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);

        Route::get('magazine/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);

        Route::get('story/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
        Route::get('{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);


    });


// });
// Route::get('/', function () {
//     return view('welcome');
// });
