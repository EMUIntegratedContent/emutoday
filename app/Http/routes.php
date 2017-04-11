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
    Route::get('events/{limit?}/{startDate?}/{endDate?}/{miniCalendar?}', 'Api\ExternalApiController@getEvents');
    Route::get('homecomingevents/{firstDate}/{lastDate}', 'Api\ExternalApiController@getHomecomingEvents');
    Route::get('eventsbydates/{limit?}/{referenceDate?}/{previous?}/{includeSelectedDate?}/{miniCalendar?}', 'Api\ExternalApiController@getEventsByDates');
    Route::get('eventshome/{limit?}/{sortBy?}', 'Api\ExternalApiController@getHomeFeaturedEvents');
    Route::get('news/current/{limit?}', 'Api\ExternalApiController@getCurrentNews');
});

Route::group(['prefix' => 'api'], function() {

    Route::patch('authors/updateitem/{id}', ['as' => 'api_authors_updateitem', 'uses' =>'Api\AuthorController@updateItem']);
    Route::get('authors/{id}/edit', ['as' => 'api_authors_edititem', 'uses' =>'Api\AuthorController@edit']);
    Route::get('authors/primarycontact', ['as' => 'api_authors_updateitem', 'uses' =>'Api\AuthorController@getCurrentPrimaryContact']);
    Route::get('authors/primarymagazinecontact', ['as' => 'api_authors_updatemagazineitem', 'uses' =>'Api\AuthorController@getCurrentPrimaryMagazineContact']);
    Route::post('authors', ['as' => 'api_authors_storeitem', 'uses' => 'Api\AuthorController@store']); // Route to save author to db
    Route::resource('authors', 'Api\AuthorController');

    Route::get('active-categories/{year?}/{month?}/{day?}','Api\CategoriesController@activeCategories');

    Route::get('calendar/month/{year?}/{month?}/{day?}','Api\CalendarController@eventsInMonth');
    Route::get('calendar/events/{year?}/{month?}/{day?}/{id?}','Api\CalendarController@eventsByDay');

    Route::patch('experts/updateitem/{id}', ['as' => 'api_experts_updateitem', 'uses' =>'Api\ExpertsController@updateItem']);
    Route::get('experts/{id}/edit', ['as' => 'api_experts_edititem', 'uses' =>'Api\ExpertsController@edit']);
    Route::get('experts/category/{id?}', ['as' => 'api_experts_category', 'uses' =>'Api\ExpertsController@expertCategory']);
    Route::post('experts', ['as' => 'api_experts_storeitem', 'uses' => 'Api\ExpertsController@store']); // Route to save expert to db
    Route::post('experts/{id}/delete', ['as' => 'api_experts_delete', 'uses' =>'Api\ExpertsController@delete']);
    Route::resource('experts', 'Api\ExpertsController');

    Route::patch('expertcategory/updateitem/{id}', ['as' => 'api_expertcategory_updateitem', 'uses' =>'Api\ExpertCategoryController@updateItem']);
    Route::get('expertcategory/{id}/edit', ['as' => 'api_expertcategory_edititem', 'uses' =>'Api\ExpertCategoryController@edit']);
    Route::get('expertcategory/all/{id?}', ['as' => 'api_expertcategory_all', 'uses' => 'Api\ExpertCategoryController@getAllCategories']);
    Route::get('expertcategory/associated/{id}', ['as' => 'api_expertcategory_associated', 'uses' => 'Api\ExpertCategoryController@getAssociatedCategories']);
    Route::post('expertcategory/{id}/delete', ['as' => 'api_expertcategory_delete', 'uses' =>'Api\ExpertCategoryController@delete']);
    Route::post('expertcategory', ['as' => 'api_expertcategory_storeitem', 'uses' => 'Api\ExpertCategoryController@store']); // Route to save expert to db
    Route::resource('expertcategory', 'Api\ExpertCategoryController');

    /**
     * List of Buildings for EventForm
     */
    Route::get('buildinglist', function() {
        $text = Input::get('q');
        return Building::likeSearch('name', $text)->select('name')->orderBy('name', 'asc')->get();
        //return Building::ofMapType('illustrated')->get();
    });
    /**
     * List of Categories for EventForm
     */
    Route::get('categorylist', function() {
        $text = Input::get('q');
        return Category::likeSearch('category', $text)->select('category', 'id as value')->orderBy('category', 'asc')->get();
    });
    /**
     * List of MiniCalendars for EventForm
     */
    Route::get('minicalslist', function() {
        return MiniCalendar::select('calendar', 'id as value', 'parent')->orderBy('calendar', 'asc')->get();
    })  ;

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

    Route::get('contactmagazinedefault', function() { // is there a way to concat first_name and last_name here?
        $author = Author::select()->where('is_principal_magazine_contact', 1)->first();

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

    Route::get('event/queueload/{fromDate?}/{toDate?}', ['as' => 'api.event.queueload', 'uses' => 'Api\EventController@queueLoad']);
    Route::get('event/lbcqueueload/{fromDate?}/{toDate?}', ['as' => 'api.event.lbcqueueload', 'uses' => 'Api\EventController@lbcQueueLoad']);
    Route::get('event/otherItems', ['as' => 'api.event.otheritems', 'uses' => 'Api\EventController@otherItems']);
    Route::get('event/unapprovedItems', ['as' => 'api.event.unapproveditems', 'uses' => 'Api\EventController@unapprovedItems']);
    Route::get('event/approvedItems', ['as' => 'api.event.approveditems', 'uses' => 'Api\EventController@approvedItems']);

    Route::patch('event/archiveitem/{id}', ['as' => 'api_event_archiveitem', 'uses' => 'Api\EventController@archiveItem']);
    Route::patch('event/updateitem/{id}', ['as' => 'api_event_updateitem', 'uses' =>'Api\EventController@updateItem']);
    Route::post('event/{id}/delete', ['as' => 'api_event_deleteitem', 'uses' => 'Api\EventController@delete']);
    Route::patch('event/{id}/cancel', ['as' => 'api_event_cancelitem', 'uses' => 'Api\EventController@cancel']);
    Route::resource('event', 'Api\EventController');

    Route::get('announcement/queueload/{atype}/{fromDate?}/{toDate?}', ['as' => 'api_announcement_queueload', 'uses' => 'Api\AnnouncementController@queueLoad']);
    Route::patch('announcement/updateitem/{id}', ['as' => 'api_announcement_updateitem', 'uses' =>'Api\AnnouncementController@updateItem']);
    Route::patch('announcement/archiveitem/{id}', ['as' => 'api_announcement_archiveitem', 'uses' => 'Api\AnnouncementController@archiveItem']);
    Route::post('announcement/{id}/delete', ['as' => 'api_announcement_deleteitem', 'uses' => 'Api\AnnouncementController@delete']);
    Route::post('announcement', ['as' => 'api_announcement_storeitem', 'uses' => 'Api\AnnouncementController@store']); // Route to save announcement submissions to db
    Route::resource('announcement', 'Api\AnnouncementController');

    // Archives API
    Route::get('archive/queueload/{archiveType}/{perPage?}', ['as' => 'api_archive_queue', 'uses' => 'Api\ArchiveController@queueLoad']);
    Route::put('archive/{archiveType}/{id}/unarchive', ['as' => 'api_archive_unarchive', 'uses' => 'Api\ArchiveController@unarchive']);
    Route::delete('archive/{archiveType}/{id}/delete', ['as' => 'api_archive_delete', 'uses' => 'Api\ArchiveController@delete']);

    Route::get('story/{story}/edit', 'Api\StoryController@edit');

    Route::get('{gtype}/{stype}/{qtype}/{fromDate?}/{toDate?}', ['as'=> 'api_storytype_queueload', 'uses'=> 'Api\StoryController@queue']);

    Route::patch('story/updateitem/{id}', ['as' => 'api_story_updateitem', 'uses' => 'Api\StoryController@updateItem']);

    Route::get('author/{id}', 'Api\StoryController@getAuthorData');
    Route::post('author', ['as' => 'api_story_storeauthor', 'uses' => 'Api\StoryController@storeAuthor']);
    Route::put('author/{id}', ['as' => 'api_story_saveauthor', 'uses' => 'Api\StoryController@saveAuthor']);
    Route::get('users/{selectedUser?}', ['as' => 'users_find_authorapi', 'uses' => 'Api\AuthorController@getUsers']);
    Route::get('authorbyuser/{userId?}', ['as' => 'authorbyuser', 'uses' => 'Api\AuthorController@getAuthorByUser']);

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

        /* EXPERTS */
        Route::group(['middleware' => 'Emutoday\Http\Middleware\ExpertsMiddleware'], function()
        {
            Route::get('experts/{id}/edit', ['as' => 'experts_edititem', 'uses' =>'Admin\ExpertsController@edit']);
            Route::get('experts/list', ['as' => 'experts_list', 'uses' => 'Admin\ExpertsController@index']);
            Route::get('experts/form', ['as' => 'experts_form', 'uses' => 'Admin\ExpertsController@form']);
            Route::resource('experts', 'Admin\ExpertsController');

            Route::get('expertcategory/list', ['as' => 'expertcategory_list', 'uses' => 'Admin\ExpertCategoryController@index']);
            Route::get('expertcategory/form', ['as' => 'expertcategory_form', 'uses' => 'Admin\ExpertCategoryController@form']);
            Route::resource('expertcategory', 'Admin\ExpertCategoryController');

            Route::patch('expertimage/{expertimage}/update',['as' => 'admin_expertimage_update', 'uses' => 'Admin\ExpertImageController@update']);
            Route::delete('expertimage/{expertimage}/delete', ['as' => 'admin_expertimage_destroy', 'uses' => 'Admin\ExpertImageController@destroy'] );
            Route::post('experts/{expert}/addnewexpertimage',['as' => 'admin_expertimage_add_new_expertimage', 'uses' => 'Admin\ExpertImageController@addNewExpertImage']);
            Route::get('expertimage/{expertimage}/confirm', ['as' => 'admin_expertimage_confirm', 'uses' => 'Admin\ExpertImageController@confirm']);
        });

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
        Route::get('announcement/{id}/unarchive', ['as' => 'admin.announcement.unarchive', 'uses' => 'Admin\AnnouncementController@unarchive']);

        Route::resource('announcement', 'Admin\AnnouncementController');

        Route::get('event/queue', ['as' => 'admin.event.queue', 'uses' => 'Admin\EventController@queue']);
        Route::get('/lbcqueue', ['as' => 'admin.event.lbcqueue', 'uses' => 'Admin\EventController@lbcqueue']);
        Route::get('event/form', ['as' => 'admin.event.form', 'uses' => 'Admin\EventController@form']);
        Route::resource('event', 'Admin\EventController');

        // Archives
        Route::get('archive/queue/{entityType}', ['as' => 'admin.archive.queue', 'uses' => 'Admin\ArchiveController@queue']);
        Route::resource('archive', 'Admin\ArchiveController');

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
