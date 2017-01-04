<?php

use Emutoday\Building;
use Emutoday\Event;
use Emutoday\Category;
use Emutoday\Story;
use Emutoday\Tag;
use Emutoday\Author;
use Emutoday\MiniCalendar;
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

Route::get('/cas/logout', function(){
    Auth::logout();
    Session::flush();
    cas()->logout();
})->middleware('auth');  //you MUST use 'auth' middleware and not 'auth.basic'. Otherwise a user won't be logged out properly.

Route::group(['prefix' => 'externalapi'], function(){
    Route::get('events/{limit?}/{startDate?}/{endDate?}', 'Api\ExternalApiController@getEvents');
    Route::get('eventshome/{limit?}/{sortBy?}', 'Api\ExternalApiController@getHomeFeaturedEvents');
    Route::get('news/current/{limit?}', 'Api\ExternalApiController@getCurrentNews');
});

Route::group(['prefix' => 'api'], function() {

    Route::patch('authors/updateitem/{id}', ['as' => 'api_authors_updateitem', 'uses' =>'Api\AuthorController@updateItem']);
    Route::get('authors/{id}/edit', ['as' => 'api_authors_edititem', 'uses' =>'Api\AuthorController@edit']);
    Route::get('authors/primarycontact', ['as' => 'api_authors_updateitem', 'uses' =>'Api\AuthorController@getCurrentPrimaryContact']);
    Route::post('authors', ['as' => 'api_authors_storeitem', 'uses' => 'Api\AuthorController@store']); // Route to save author to db
    Route::resource('authors', 'Api\AuthorController');

    Route::get('active-categories/{year?}/{month?}/{day?}','Api\CategoriesController@activeCategories');

    Route::get('calendar/month/{year?}/{month?}/{day?}','Api\CalendarController@eventsInMonth');
    Route::get('calendar/events/{year?}/{month?}/{day?}/{id?}','Api\CalendarController@eventsByDay');

    Route::post('calendar/addevent', 'Api\CalendarController@addEventToGoogleCalendar')->name('addEventToGoogleCalendar');
    Route::get('oauth2callback', 'Api\CalendarController@oAuth');
    Route::get('calendarauth', 'Api\CalendarController@oAuthAPIConfirm');


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
    });
    /**
     * List of MiniCalendars for EventForm
     */
    Route::get('minicalslist', function() {
        return MiniCalendar::select('calendar', 'id as value')->get();
    });

    Route::get('authorlist', function() { // is there a way to concat first_name and last_name here?
        return Author::select(DB::raw('CONCAT(first_Name, " ", last_Name) AS name'), 'id as value')->get();
    });

    Route::get('contactlist', function() { // is there a way to concat first_name and last_name here?
        return Author::select(DB::raw('CONCAT(first_Name, " ", last_Name) AS name'), 'id as value')->where('is_contact', 1)->get();
    });

    Route::get('contactdefault', function() { // is there a way to concat first_name and last_name here?
        $author = Author::select()->where('is_principal_contact', 1)->first();

        return $author;
    });

    Route::get('contactlist/{id}', function($id) {
        $contact = Story::find($id)->contact()->select(DB::raw('CONCAT(first_Name, " ", last_Name) AS name'), 'id as value')->get();

        return $contact;
    });

    Route::get('taglist/{id}', function($id) {
        $tags = Story::find($id)->tags()->select('name', 'id as value')->get();

        return $tags;
    });

    Route::get('taglist', function() {
        return Tag::select('name', 'id as value')->get();
    });

    Route::patch('event/updateItem/{event}', 'Api\EventController@updateItem');
    Route::post('event/addMediaFile/{event}', 'Api\EventController@addMediaFile');
    Route::post('event/removeMediaFile/{event}', 'Api\EventController@removeMediaFile');

    Route::get('event/queueload', ['as' => 'api.event.queueload', 'uses' => 'Api\EventController@queueLoad']);
    Route::get('event/lbcqueueload', ['as' => 'api.event.lbcqueueload', 'uses' => 'Api\EventController@lbcQueueLoad']);
    Route::get('event/otherItems', ['as' => 'api.event.otheritems', 'uses' => 'Api\EventController@otherItems']);
    Route::get('event/unapprovedItems', ['as' => 'api.event.unapproveditems', 'uses' => 'Api\EventController@unapprovedItems']);
    Route::get('event/approvedItems', ['as' => 'api.event.approveditems', 'uses' => 'Api\EventController@approvedItems']);

    Route::patch('event/archiveitem/{id}', ['as' => 'api_event_archiveitem', 'uses' => 'Api\EventController@archiveItem']);
    Route::patch('event/updateitem/{id}', ['as' => 'api_event_updateitem', 'uses' =>'Api\EventController@updateItem']);
    Route::post('event/{id}/delete', ['as' => 'api_event_deleteitem', 'uses' => 'Api\EventController@delete']);
    Route::patch('event/{id}/cancel', ['as' => 'api_event_cancelitem', 'uses' => 'Api\EventController@cancel']);
    Route::resource('event', 'Api\EventController');


    Route::get('announcement/queueload/{atype}', ['as' => 'api_announcement_queueload', 'uses' => 'Api\AnnouncementController@queueLoad']);
    Route::patch('announcement/updateitem/{id}', ['as' => 'api_announcement_updateitem', 'uses' =>'Api\AnnouncementController@updateItem']);
    Route::patch('announcement/archiveitem/{id}', ['as' => 'api_announcement_archiveitem', 'uses' => 'Api\AnnouncementController@archiveItem']);
    Route::post('announcement/{id}/delete', ['as' => 'api_announcement_deleteitem', 'uses' => 'Api\AnnouncementController@delete']);
    Route::post('announcement', ['as' => 'api_announcement_storeitem', 'uses' => 'Api\AnnouncementController@store']); // Route to save announcement submissions to db
    Route::resource('announcement', 'Api\AnnouncementController');



    Route::get('story/{story}/edit', 'Api\StoryController@edit');

    Route::get('{gtype}/{stype}/{qtype}', ['as'=> 'api_storytype_queueload', 'uses'=> 'Api\StoryController@queue']);

    Route::patch('story/updateitem/{id}', ['as' => 'api_story_updateitem', 'uses' => 'Api\StoryController@updateItem']);

    Route::get('author/{id}', 'Api\StoryController@getAuthorData');
    Route::post('author', ['as' => 'api_story_storeauthor', 'uses' => 'Api\StoryController@storeAuthor']);
    Route::put('author/{id}', ['as' => 'api_story_saveauthor', 'uses' => 'Api\StoryController@saveAuthor']);


    Route::patch('story/archiveitem/{id}', ['as' => 'api_story_archiveitem', 'uses' => 'Api\StoryController@archiveItem']);

    Route::resource('story', 'Api\StoryController');


    Route::get('page/chartload', ['as' => 'api_page_chartload', 'uses' => 'Api\PageController@chartLoad']);

    Route::get('page/queueload', ['as' => 'api.page.queueload', 'uses' => 'Api\PageController@queueLoad']);

});

    Route::get('emichlogin', ['as' => 'emich-login', function() {
        return view('public.emichlogin', ['form' => 'event']);
    }]);

    Route::group(['prefix' => 'auth' ], function()
    {
      // Route::post('/emichlogin', function(){
      //   return 'login';
      // });
      Route::post('/emichlogin', ['as' => 'emich-login', 'uses' => 'Auth\AuthController@guest']);
    });

    Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);

    Route::get('announcement/form', 'Today\AnnouncementController@announcementForm');
    Route::get('announcement/user/announcements', 'Today\AnnouncementController@userAnnouncements');
    Route::get('announcement/{id?}', 'Today\AnnouncementController@index'); // Does not exist??

    Route::get('calendar/event/form', 'Today\CalendarController@eventForm');
    Route::get('calendar/user/events', 'Today\CalendarController@userEvents');
    Route::get('calendar/event/{id}', 'Today\CalendarController@show');
    Route::get('calendar/{year?}/{month?}/{day?}/{id?}', 'Today\CalendarController@index');

    Route::get('magazine/archives', 'Today\MagazineController@archives');
    Route::get('magazine/article/{id?}', 'Today\MagazineController@article');
    Route::get('magazine/issue/{year?}/{season?}', 'Today\MagazineController@issue');
    Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');

    Route::get('hub', 'MainController@index');

    Route::get('search','SearchController@search' );
    Route::get('search/story/{id}','SearchController@story' );
    Route::get('search/event/{id}','SearchController@event' );
    Route::get('search/announcement/{id}','SearchController@annou/Authnnncement' );

    Route::get('story/{stype}/{id?}', 'Today\StoryController@story');

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
        Route::get('authors/list', ['as' => 'authors_list', 'uses' => 'Admin\AuthorsController@index']);
        Route::get('authors/form', ['as' => 'authors_form', 'uses' => 'Admin\AuthorsController@form']);
        Route::resource('authors', 'Admin\AuthorsController');

        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
        Route::get('search', ['as' => 'admin.search', 'uses' => 'Admin\DashboardController@search']);

        Route::post('user/{user}/addMediafileUser', ['as' => 'store_mediafile_user', 'uses' => 'Admin\MediafileController@addMediafileUser']);
        Route::post('user/{user}/updateMediafileUser', ['as' => 'update_mediafile_user', 'uses' => 'Admin\MediafileController@updateMediafileUser']);
        Route::delete('user/{user}/removeMediafileUser', ['as' => 'remove_mediafile_user', 'uses' => 'Admin\MediafileController@removeMediafileUser']);

        Route::get('user/{user}/edit', ['as' => 'admin_user_edit', 'uses' => 'Admin\UserController@edit']);
        Route::get('user/{user}/confirm', ['as' => 'admin_user_confirm', 'uses' => 'Admin\UserController@confirm']);
        Route::delete('user/{user}/destroy', ['as' => 'admin_user_destroy', 'uses' => 'Admin\UserController@destroy']);
        Route::get('user/form', 'Admin\UserController@form');
        Route::resource('user', 'Admin\UserController');

        Route::resource('mediafile', 'Admin\MediafileController');
        Route::get('announcement/archives', ['as' => 'admin.announcement.archives', 'uses' => 'Admin\AnnouncementController@archives']);
        Route::get('announcement/queue/{atype?}', ['as' => 'admin.announcement.queue', 'uses' => 'Admin\AnnouncementController@queue']);
        Route::get('announcement/form/{atype?}', ['as' => 'admin.announcement.form', 'uses' => 'Admin\AnnouncementController@form']);

        Route::resource('announcement', 'Admin\AnnouncementController');

        Route::get('event/queue', ['as' => 'admin.event.queue', 'uses' => 'Admin\EventController@queue']);
        Route::get('/lbcqueue', ['as' => 'admin.event.lbcqueue', 'uses' => 'Admin\EventController@lbcqueue']);
        Route::get('event/form', ['as' => 'admin.event.form', 'uses' => 'Admin\EventController@form']);
        Route::resource('event', 'Admin\EventController');

        Route::get('page/form', ['as' => 'admin_page_form', 'uses' => 'Admin\PageController@form']);
        Route::get('page/{page}/edit', ['as' => 'admin_page_edit', 'uses' => 'Admin\PageController@edit']);
        Route::post('page/delete', ['as' => 'admin_page_delete', 'uses' => 'Admin\PageController@delete'] );
        Route::get('page/destroy/{id?}', ['as' => 'admin_page_destroy', 'uses' => 'Admin\PageController@destroy'] );
        Route::resource('page', 'Admin\PageController');

        Route::get('magazine/form', ['as' => 'admin_magazine_form', 'uses' => 'Admin\MagazineController@form']);
        Route::get('magazine/archives', ['as' => 'admin_magazine_archives', 'uses' => 'Admin\MagazineController@archives']);
        Route::get('magazine/{magazine}/edit', ['as' => 'admin_magazine_edit', 'uses' => 'Admin\MagazineController@edit']);
        Route::get('magazine/delete/{id?}', ['as' => 'admin_magazine_delete', 'uses' => 'Admin\MagazineController@delete'] );
        Route::post('magazine/{magazine}/addCoverImage', ['as' => 'store_magazine_cover', 'uses' => 'Admin\MagazineController@addCoverImage']);
        Route::put('magazine/{mediafile}/updateCoverImage/', ['as' => 'update_magazine_cover', 'uses' => 'Admin\MagazineController@updateCoverImage']);
        Route::resource('magazine', 'Admin\MagazineController');

        Route::patch('storyimage/{storyimage}/update',['as' => 'admin_storyimage_update', 'uses' => 'Admin\StoryImageController@update']);
        Route::delete('storyimage/{storyimage}/delete', ['as' => 'admin_storyimage_destroy', 'uses' => 'Admin\StoryImageController@destroy'] );

        Route::resource('storyimages', 'Admin\StoryImageController');

        Route::post('promotestory', ['as'=> 'admin_promotestory', 'uses'=> 'Admin\StoryController@promoteStory']);
        Route::put('story/{id}/updatefrompreview', ['as'=> 'admin_preview_story_update', 'uses'=> 'Admin\StoryController@updateFromPreview']);

        Route::post('{qtype}/{gtype}/{stype}/{story}/addnewstoryimage',['as' => 'admin_storyimage_add_new_storyimage', 'uses' => 'Admin\StoryImageController@addNewStoryImage']);
        Route::get('storyimage/{storyimage}/confirm', ['as' => 'admin_storyimage_confirm', 'uses' => 'Admin\StoryImageController@confirm']);

        Route::resource('mediafile', 'Admin\MediafileController');
        Route::resource('role', 'Admin\RoleController');
        Route::resource('permission', 'Admin\PermissionController');

        Route::get('story/queueall', ['as' => 'admin_story_queue', 'uses' => 'Admin\StoryTypeController@queueAll']);
        Route::get('magazine/article/queuearticle', ['as'=> 'admin_magazine_article_queue', 'uses'=> 'Admin\StoryTypeController@queueArticle']);

        Route::get('story/{stype}/queueall', ['as' => 'admin_storytype_queueall', 'uses' => 'Admin\StoryTypeController@queueAll']);

        Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryTypeController@articleSetup']);

        Route::get('magazine/{stype}/{story}/edit', ['as' => 'admin_magazine_article_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);
        Route::get('story/{stype}/setup', ['as' => 'admin_storytype_setup', 'uses' => 'Admin\StoryTypeController@storyTypeSetUp']);


        Route::get('{gtype}/{stype}/{qtype}','Admin\StoryTypeController@queue' );

        Route::get('{qtype}/{gtype}/{stype}/form','Admin\StoryTypeController@storyTypeForm' );

        Route::get('{qtype}/{gtype}/{stype}/{story}/edit','Admin\StoryTypeController@storyTypeEdit' );

    });

    Route::group(['prefix' => 'preview' ], function()
    {
        Route::get('page/{page}/', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
        Route::get('magazine/{magazine}/', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);

        Route::get('magazine/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
        Route::get('return/{gtype}/{stype}/{qtype}/{recordid}', 'PreviewController@goBack');

        Route::get('{qtype}/{gtype}/{stype}/{story}', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
    });
