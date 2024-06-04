<?php

use Emutoday\User;
use Emutoday\Building;
use Emutoday\Event;
use Emutoday\Category;
use Emutoday\Story;
use Emutoday\StoryIdeaMedium;
use Emutoday\Tag;
use Emutoday\Author;
use Emutoday\MiniCalendar;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

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

Route::get('/testoauth', function () {
  return response()->json("Now that's what I call a secure API!");
})->middleware('client_credentials');

/***************
 * Mailgun Webhook Routes
 */
Route::group(['prefix' => 'mailgun'], function () {
  Route::post('open', 'Api\MailgunApiController@postOpen');
  Route::post('click', 'Api\MailgunApiController@postClick');
  Route::post('spam', 'Api\MailgunApiController@postSpam');
});

/***************
 * CAS Routes
 */
Route::get('/cas/logout', function () {
  Auth::logout();
  Session::flush();
  cas()->logout();
})->middleware('auth');  //you MUST use 'auth' middleware and not 'auth.basic'. Otherwise, a user won't be logged out properly.

/***************
 * RSS Feed Routes
 */
Route::get('/feed/news/{type?}', 'Today\RSSFeedController@getNews')->name('rss_feed_news');
Route::get('/feed/events/{type?}', 'Today\RSSFeedController@getEvents')->name('rss_feed_events');
Route::get('/feed/announcements/{type?}', 'Today\RSSFeedController@getAnnouncements')->name('rss_feed_announcements');
Route::get('/feed/minical/{minical?}', 'Today\RSSFeedController@getEventsICalMinical')->name('ical_events_minical');
Route::get('/feed/ical', 'Today\RSSFeedController@getEventsICal')->name('ical_events');

/***************
 * External API Routes
 */
Route::group(['prefix' => 'externalapi', 'middleware' => ['bindings']], function () {
  Route::get('events/{limit?}/{startDate?}/{endDate?}/{miniCalendar?}', 'Api\ExternalApiController@getEvents');
  Route::get('hscevents/{limit?}/{startDate?}/{endDate?}', 'Api\ExternalApiController@getHscEvents');
  Route::get('homecomingevents/{firstDate}/{lastDate}', 'Api\ExternalApiController@getHomecomingEvents');
  Route::get('eventsbydates_v2/{limit?}/{referenceDate?}/{previous?}/{includeSelectedDate?}', 'Api\ExternalApiController@getEventsByDatesV2');
  Route::get('eventsbydates/{limit?}/{referenceDate?}/{previous?}/{includeSelectedDate?}/{miniCalendar?}', 'Api\ExternalApiController@getEventsByDates');
  Route::get('hsceventsbydates/{limit?}/{referenceDate?}/{previous?}/{includeSelectedDate?}', 'Api\ExternalApiController@getHscEventsByDates');
  Route::get('eventshome/{limit?}/{sortBy?}', 'Api\ExternalApiController@getHomeFeaturedEvents');
  Route::get('news/current/{limit?}', 'Api\ExternalApiController@getCurrentNews');
  Route::post('events/campuslife/update/{id}', 'Api\ExternalApiController@updateCampusLifeEvent');
  Route::post('events/campuslife/cancel/{id}', 'Api\ExternalApiController@cancelCampusLifeEvent');
  Route::post('events/campuslife/delete/{id}', 'Api\ExternalApiController@deleteCampusLifeEvent');
  Route::post('events/campuslife/new', 'Api\ExternalApiController@createCampusLifeEvent');
});

/***************
 * Internal API Routes
 */
Route::group(['prefix' => 'api', 'middleware' => ['bindings']], function () {

	/* Intcomm Ideas */
	Route::get('intcomm/ideas/admin/ideas', 'Api\IntcommIdeaAdminController@index')->name('api_intcomm_admin_ideas');
	Route::get('intcomm/ideas/admin/{ideaId}', 'Api\IntcommIdeaAdminController@show')->name('api_intcomm_admin_idea');
	Route::put('intcomm/ideas/admin/{ideaId}/archive', 'Api\IntcommIdeaAdminController@archive')->name('api_intcomm_admin_idea_archive');
	Route::put('intcomm/ideas/admin/{ideaId}/unarchive', 'Api\IntcommIdeaAdminController@unarchive')->name('api_intcomm_admin_idea_unarchive');
	Route::put('intcomm/ideas/admin/{ideaId}/status', 'Api\IntcommIdeaAdminController@status')->name('api_intcomm_admin_idea_status');
	Route::delete('intcomm/ideas/admin/{ideaId}', 'Api\IntcommIdeaAdminController@destroy')->name('api_intcomm_admin_idea_delete');
	Route::post('intcomm/ideas/admin/{ideaId}/makepost', 'Api\IntcommIdeaAdminController@makepost')->name('api_intcomm_admin_makepost');
	Route::get('intcomm/ideas/user/{ideaId}', 'Api\IntcommIdeaPublicController@show')->name('api_intcomm_user_idea');
	Route::get('intcomm/ideas/user', 'Api\IntcommIdeaPublicController@index')->name('api_intcomm_user_ideas');
	Route::post('intcomm/ideas/user', 'Api\IntcommIdeaPublicController@store')->name('api_intcomm_user_ideas_store');
	Route::put('intcomm/ideas/user/{ideaId}', 'Api\IntcommIdeaPublicController@update')->name('api_intcomm_user_ideas_update');
	/* Intcomm Posts */
	Route::get('intcomm/posts/{postId}', 'Api\IntcommPostController@show')->name('api_intcomm_post');
	Route::get('intcomm/posts', 'Api\IntcommPostController@index')->name('api_intcomm_posts');

  /* STORY IDEAS */
  Route::resource('storyideas', 'Api\StoryIdeasController');

  /* MEDIA HIGHLIGHTS */
  Route::get('mediahighlights/taglist', 'Api\MediaHighlightController@getTaglist');
  Route::get('mediahighlights/taglist/{id}', 'Api\MediaHighlightController@getTaglist');
  Route::post('mediahighlights/tag/store', 'Api\MediaHighlightController@storeTag');
  Route::resource('mediahighlights', 'Api\MediaHighlightController');

  /* AUTHORS */
  Route::patch('authors/updateitem/{id}', 'Api\AuthorController@updateItem')->name('api_authors_updateitem');
  Route::get('authors/{id}/edit', 'Api\AuthorController@edit')->name('api_authors_edititem');
  Route::get('authors/primarycontact', 'Api\AuthorController@getCurrentPrimaryContact')->name('api_authors_updateitem');
  Route::get('authors/primarymagazinecontact', 'Api\AuthorController@getCurrentPrimaryMagazineContact')->name('api_authors_updatemagazineitem');
  Route::post('authors', 'Api\AuthorController@store')->name('api_authors_storeitem'); // Route to save author to db
  Route::resource('authors', 'Api\AuthorController');

  Route::get('active-categories/{year?}/{month?}/{day?}', 'Api\CategoriesController@activeCategories');

  Route::get('calendar/month/{year?}/{month?}/{day?}', 'Api\CalendarController@eventsInMonth');
  Route::get('calendar/events/{year?}/{month?}/{day?}/{id?}', 'Api\CalendarController@eventsByDay');

  Route::get('email/stories/main/{fromDate?}/{toDate?}', 'Api\EmailController@getMainEmailReadyStories')->name('api_email_main_stories');
  Route::get('email/stories/otherstories/{fromDate?}/{toDate?}', 'Api\EmailController@getAllEmailReadyStories')->name('api_email_other_stories');
  Route::get('email/events/{fromDate?}/{toDate?}', 'Api\EmailController@getAllEmailReadyEvents')->name('api_email_events');
  Route::get('email/announcements/{fromDate?}/{toDate?}', 'Api\EmailController@getAllEmailReadyAnnouncements')->name('api_email_announcements');
  Route::get('email/recipients', 'Api\EmailController@getAllRecipients')->name('api_email_recipients_get');
  Route::post('email/recipients', 'Api\EmailController@saveRecipient')->name('api_email_recipients_save');
  Route::post('email/clone', 'Api\EmailController@cloneEmail')->name('api_email_clone');
  Route::resource('email', 'Api\EmailController');

  Route::patch('experts/updateitem/{id}', 'Api\ExpertsController@updateItem')->name('api_experts_updateitem');
  Route::get('experts/{id}/edit', 'Api\ExpertsController@edit')->name('api_experts_edititem');
  Route::get('experts/category/{id?}', 'Api\ExpertsController@expertCategory')->name('api_experts_category');
  Route::get('experts/previoustitles/{id?}', 'Api\ExpertsController@expertPreviousTitles')->name('api_experts_previoustitles');
  Route::get('experts/education/{id?}', 'Api\ExpertsController@expertEducation')->name('api_experts_education');
  Route::get('experts/expertise/{id?}', 'Api\ExpertsController@expertExpertise')->name('api_experts_expertise');
  Route::get('experts/languages/{id?}', 'Api\ExpertsController@expertLanguages')->name('api_experts_languages');
  Route::get('experts/social/{id?}', 'Api\ExpertsController@expertSocialMediaLinks')->name('api_experts_social');
  Route::get('experts/list/{id?}', 'Api\ExpertsController@getExperts')->name('api_experts_list');
  Route::get('experts/search/{term?}', 'Api\ExpertsController@searchExperts')->name('api_experts_search');
  Route::post('experts', 'Api\ExpertsController@store')->name('api_experts_storeitem'); // Route to save expert to db
  Route::post('experts/{id}/delete', 'Api\ExpertsController@delete')->name('api_experts_delete');
  Route::resource('experts', 'Api\ExpertsController');

  Route::patch('expertcategory/updateitem/{id}', 'Api\ExpertCategoryController@updateItem')->name('api_expertcategory_updateitem');
  Route::get('expertcategory/{id}/edit', 'Api\ExpertCategoryController@edit')->name('api_expertcategory_edititem');
  Route::get('expertcategory/all/{id?}', 'Api\ExpertCategoryController@getAllCategories')->name('api_expertcategory_all');
  Route::get('expertcategory/associated/{id}', 'Api\ExpertCategoryController@getAssociatedCategories')->name('api_expertcategory_associated');
  Route::post('expertcategory/{id}/delete', 'Api\ExpertCategoryController@delete')->name('api_expertcategory_delete');
  Route::post('expertcategory', 'Api\ExpertCategoryController@store')->name('api_expertcategory_storeitem'); // Route to save expert to db
  Route::resource('expertcategory', 'Api\ExpertCategoryController');

  Route::put('expertmediarequest/{id}', 'Api\ExpertMediaRequestController@updateItem')->name('api_expertmediarequest_updateitem');
  Route::post('expertmediarequest', 'Api\ExpertMediaRequestController@store')->name('api_expertmediarequest_store'); // Save expert media request to db
  Route::get('expertmediarequest/{id}', 'Api\ExpertMediaRequestController@getExpertMediaRequest')->name('api_expertmediarequest_get');
  Route::get('expertmediarequest/list/search', 'Api\ExpertMediaRequestController@search')->name('api_expertmediarequest_search');
  Route::post('expertspeakerrequest', 'Api\ExpertSpeakerRequestController@store')->name('api_expertspeakerrequest_store'); // Save expert speaker request to db

  Route::get('magazine/articles/{fromDate?}/{toDate?}', 'Api\MagazineController@getArticles')->name('api_magazine_articles');
  Route::get('magazine/issuearticles/{issue_id}', 'Api\MagazineController@getArticlesForIssue')->name('api_magazine_articles_issue');
  Route::put('magazine/savearticles/', 'Api\MagazineController@saveArticles')->name('api_magazine_save_articles');
  /**
   * List of Buildings for EventForm
   */
  Route::get('buildinglist', function () {
    $text = Input::get('q');
    return Building::likeSearch('name', $text)->select('name')->orderBy('name', 'asc')->get();
  });
  /**
   * List of Categories for EventForm
   */
  Route::get('categorylist', function () {
    $text = Input::get('q');
    return Category::likeSearch('category', $text)->select('category', 'id as value')->orderBy('category', 'asc')->get();
  });
  /**
   * List of MiniCalendars for EventForm
   */
  Route::get('minicalslist', function () {
    return MiniCalendar::select('calendar', 'id as value', 'parent')->where('calendar', '<>', 'Welcome Weeks')->orderBy('calendar', 'asc')->get();
  });

  Route::get('authorlist', function () {
    return Author::select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->where('hidden', 0)->orderBy('last_Name', 'asc')->get();
  });

  Route::get('contactlist', function () {
    return Author::select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->where('hidden', 0)->where('is_contact', 1)->orderBy('last_Name', 'asc')->get();
  });

  Route::get('contactdefault', function () {
    $author = Author::select()->where('hidden', 0)->where('is_principal_contact', 1)->first();

    return $author;
  });

  Route::get('contactmagazinedefault', function () {
    $author = Author::select()->where('hidden', 0)->where('is_principal_magazine_contact', 1)->first();

    return $author;
  });

  Route::get('contactlist/{id}', function ($id) {
    return Story::find($id)->contact()->select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->get();

  });

  Route::get('taglist/{id}', function ($id) {
    $tags = Story::find($id)->tags()->select('name', 'id as value')->get();

    return $tags;
  });

  Route::get('taglist', function () {
    return Tag::select('name', 'id as value')->get();
  });

  Route::get('storyideamedia', function () {
    return StoryIdeaMedium::select('medium', 'id as value')->orderBy('medium', 'asc')->get();
  });

  Route::get('storyideaassignees', function () {
    return User::select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->where('hidden', 0)->where('is_idea_assignee', 1)->orderBy('last_name', 'asc')->get();
  });

  Route::get('userlist', function () {
    return User::select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->where('hidden', 0)->orderBy('last_name', 'asc')->get();
  });

  Route::patch('event/updateItem/{event}', 'Api\EventController@updateItem');
  Route::post('event/addMediaFile/{event}', 'Api\EventController@addMediaFile');
  Route::post('event/removeMediaFile/{event}', 'Api\EventController@removeMediaFile');

  Route::get('event/queueload/{fromDate?}/{toDate?}', 'Api\EventController@queueLoad')->name('api.event.queueload');
  Route::get('event/lbcqueueload/{fromDate?}/{toDate?}', 'Api\EventController@lbcQueueLoad')->name('api.event.lbcqueueload');
  Route::get('event/hscqueueload/{fromDate?}/{toDate?}', 'Api\EventController@hscQueueLoad')->name('api.event.hscqueueload');
  Route::get('event/otherItems', 'Api\EventController@otherItems')->name('api.event.otheritems');
  Route::get('event/unapprovedItems', 'Api\EventController@unapprovedItems')->name('api.event.unapproveditems');
  Route::get('event/approvedItems', 'Api\EventController@approvedItems')->name('api.event.approveditems');

  Route::patch('event/archiveitem/{id}', 'Api\EventController@archiveItem')->name('api_event_archiveitem');
  Route::patch('event/updateitem/{id}', 'Api\EventController@updateItem')->name('api_event_updateitem');
  Route::post('event/{id}/delete', 'Api\EventController@delete')->name('api_event_deleteitem');
  Route::patch('event/{id}/cancel', 'Api\EventController@cancel')->name('api_event_cancelitem');
  Route::put('event/elevated/reorder', 'Api\EventController@reorderElevatedEvents')->name('api_event_elevated_reorder');
  Route::get('event/elevated', 'Api\EventController@getElevatedEvents')->name('api_event_elevated');
  Route::resource('event', 'Api\EventController');

  Route::get('announcement/queueload/{atype}/{fromDate?}/{toDate?}', 'Api\AnnouncementController@queueLoad')->name('api_announcement_queueload');
  Route::put('announcement/elevated/reorder/{atype?}', 'Api\AnnouncementController@reorderElevatedAnnouncements')->name('api_announcement_elevated_reorder');
  Route::patch('announcement/updateitem/{id}', 'Api\AnnouncementController@updateItem')->name('api_announcement_updateitem');
  Route::patch('announcement/archiveitem/{id}', 'Api\AnnouncementController@archiveItem')->name('api_announcement_archiveitem');
  Route::post('announcement/{id}/delete', 'Api\AnnouncementController@delete')->name('api_announcement_deleteitem');
  Route::get('announcement/archive', 'Api\AnnouncementController@archives')->name('api_announcement_archive');
  Route::get('announcement/elevated/{atype?}', 'Api\AnnouncementController@getElevatedAnnouncements')->name('api_announcement_elevated');
  Route::post('announcement', 'Api\AnnouncementController@store')->name('api_announcement_storeitem'); // Route to save announcement submissions to db
  Route::resource('announcement', 'Api\AnnouncementController');

  Route::get('page/stories/{fromDate?}/{toDate?}', 'Api\PageController@getHubReadyStories')->name('api_hub_stories');
  Route::get('page/chartload', 'Api\PageController@chartLoad')->name('api_page_chartload');
  Route::get('page/queueload', 'Api\PageController@queueLoad')->name('api.page.queueload');
  //Route::post('page', 'Api\PageController@saveHubPage')->name('api_save_hub_page');
  Route::resource('page', 'Api\PageController');

  // Archives API
  Route::get('archive/queueload/{archiveType}/{perPage?}', 'Api\ArchiveController@queueLoad')->name('api_archive_queue');
  Route::put('archive/{archiveType}/{id}/unarchive', 'Api\ArchiveController@unarchive')->name('api_archive_unarchive');
  Route::delete('archive/{archiveType}/{id}/delete', 'Api\ArchiveController@delete')->name('api_archive_delete');

  Route::get('story/emu175stories/{fromDate?}/{toDate?}', 'Api\StoryController@getEmu175Stories')->name('api_story_emu175');
  Route::get('story/{story}/edit', 'Api\StoryController@edit');
  Route::post('story/updateemu175', 'Api\StoryController@updateEmu175Story')->name('api_story_updateemu175');

  Route::get('{gtype}/{stype}/{qtype}/{fromDate?}/{toDate?}', 'Api\StoryController@queue')->name('api_storytype_queueload');

  Route::patch('story/updateitem/{id}', 'Api\StoryController@updateItem')->name('api_story_updateitem');

  Route::get('author/{id}', 'Api\StoryController@getAuthorData');
  Route::post('author', 'Api\StoryController@storeAuthor')->name('api_story_storeauthor');
  Route::put('author/{id}', 'Api\StoryController@saveAuthor')->name('api_story_saveauthor');
  Route::get('users/{selectedUser?}', 'Api\AuthorController@getUsers')->name('users_find_authorapi');
  Route::get('authorbyuser/{userId?}', 'Api\AuthorController@getAuthorByUser')->name('authorbyuser');

  Route::put('story/elevated/reorder', 'Api\StoryController@reorderElevatedStorys')->name('api_story_elevated_reorder');
  Route::patch('story/archiveitem/{id}', 'Api\StoryController@archiveItem')->name('api_story_archiveitem');
  Route::get('story/elevated', 'Api\StoryController@getElevatedStorys')->name('api_story_elevated');
  Route::resource('story', 'Api\StoryController');
});
// ^^ END API ROUTES

Route::get('/', 'MainController@index')->name('home');
Route::get('forthemedia', 'MainController@forTheMediaIndex');

Route::get('announcement/form', 'Today\AnnouncementController@announcementForm');
Route::get('announcement/user/announcements', 'Today\AnnouncementController@userAnnouncements');
Route::get('announcement/{id?}', 'Today\AnnouncementController@index'); // Does not exist??

Route::get('calendar/event/form', 'Today\CalendarController@eventForm');
Route::get('calendar/user/events', 'Today\CalendarController@userEvents');
Route::get('calendar/event/{id}', 'Today\CalendarController@show');
Route::get('calendar/{year?}/{month?}/{day?}/{id?}', 'Today\CalendarController@index');

//
Route::get('magazine/archives', 'Today\MagazineController@archives');
Route::get('magazine/article/{id?}', 'Today\MagazineController@article');
Route::get('magazine/issue/{year?}/{season?}', 'Today\MagazineController@issue');
Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');
Route::get('magazine/{year?}/{season?}', 'Today\MagazineController@index');
//

Route::get('hub', 'MainController@index');

Route::get('feedback', function () {
  return view('public.feedback');
});
Route::post('feedback', 'MainController@feedbackForm');

Route::get('subscribe', function () {
  return view('public.subscribe');
});
Route::post('subscribe', 'MainController@subscribeForm');

Route::get('search', 'SearchController@search');
Route::get('search/story/{id}', 'SearchController@story');
Route::get('search/event/{id}', 'SearchController@event');
Route::get('search/announcement/{id}', 'SearchController@annou/Authnnncement');

Route::get('story/{stype}/{id?}', 'Today\StoryController@story');

Route::get('experts/view/{id}', 'Today\ExpertsController@show')->name('expertview');
Route::get('experts/user/experts', 'Today\ExpertsController@userExperts');
Route::get('experts/find', 'SearchController@expertSearch')->name('expertsearch');
Route::get('experts/form', 'Today\ExpertsController@expertForm');
Route::get('experts/contact', function () {
  return view('public.experts.contact');
});
Route::get('experts/speakerrequest/{expertId?}', 'Today\ExpertSpeakerRequestController@index');
Route::get('experts/mediarequest/{expertId?}', 'Today\ExpertMediaRequestController@index');
Route::get('experts', 'Today\ExpertsController@index');
Route::resource('experts', 'Today\ExpertsController');
//Route::resource('expertrequest', 'Today\ExpertRequestController');

//    Route::auth();
//    //watch out for match anything ROUTES
//    Route::group(['prefix' => 'preview', 'middleware' => ['bindings']   ], function()
//    {
//        Route::get('experts/{id}', 'PreviewController@expert')->name('preview_experts');
//
//        Route::get('page/{page}/', 'PreviewController@hub')->name('preview_hub');
//        Route::get('magazine/{magazine}/', 'PreviewController@magazine')->name('preview_magazine');
//
//        Route::get('magazine/{stype}/{story}/', 'PreviewController@story')->name('preview_story');
//
//        Route::get('story/{stype}/{story}/', 'PreviewController@story')->name('preview_story');
//        Route::get('{stype}/{story}/', 'PreviewController@story')->name('preview_story');
//    });

/***************
 * Admin Routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['bindings']], function () {
  Route::group(['prefix' => 'preview', 'middleware' => ['bindings']], function () {
    Route::get('experts/{id}', 'PreviewController@expert')->name('preview_experts');
    Route::get('page/{page}/', 'PreviewController@hub')->name('preview_hub');
    Route::get('magazine/{magazine}/', 'PreviewController@magazine')->name('preview_magazine');

    Route::get('magazine/{stype}/{story}/', 'PreviewController@story')->name('preview_story');
    Route::get('return/{gtype}/{stype}/{qtype}/{recordid}', 'PreviewController@goBack');

    Route::get('{qtype}/{gtype}/{stype}/{story}', 'PreviewController@story')->name('preview_story');
  });


  Route::get('mediahighlightstags/{id}/destroy', 'Admin\MediaHighlightTagController@destroy');

  Route::get('oauth/list', 'Admin\OAuthController@listClients')->name('list_user_oauth_clients');

  Route::get('authors/list', 'Admin\AuthorsController@index')->name('authors_list');
  Route::get('authors/form', 'Admin\AuthorsController@form')->name('authors_form');
  Route::resource('authors', 'Admin\AuthorsController');

  Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::get('search', 'Admin\DashboardController@search')->name('admin.search');

  /* STORY IDEAS */
  Route::group(['middleware' => ['storyideas']], function () {
    Route::get('storyideas/form', 'Admin\StoryIdeaController@form');
    Route::resource('storyideas', 'Admin\StoryIdeaController');
  });

  /* EXPERTS */
  Route::group(['middleware' => ['experts']], function () {
    Route::patch('expertimage/{expertimage}/update', 'Admin\ExpertImageController@update')->name('admin_expertimage_update');
    Route::delete('expertimage/{expertimage}/delete', 'Admin\ExpertImageController@destroy')->name('admin_expertimage_destroy');
    Route::get('experts/{expert}/addnewexpertimage', 'Admin\ExpertImageController@addNewExpertImage')->name('admin_expertimage_add_new_expertimage');
    Route::get('expertimage/{expertimage}/confirm', 'Admin\ExpertImageController@confirm')->name('admin_expertimage_confirm');

    Route::put('experts/{id}/updatefrompreview', 'Admin\ExpertsController@updateFromPreview')->name('admin_preview_expert_update');
    Route::get('experts/{id}/edit', 'Admin\ExpertsController@edit')->name('admin_expert_edit');
    Route::get('experts/form', 'Admin\ExpertsController@form')->name('admin_expert_form');
    Route::get('experts', 'Admin\ExpertsController@index')->name('admin_experts');
    //Route::resource('experts', 'Admin\ExpertsController');

    Route::resource('expertcategory', 'Admin\ExpertCategoryController');
    Route::resource('expertrequests', 'Admin\ExpertRequestController');
  });

  /* EMAILS */
  Route::group(['middleware' => ['email']], function () {
    Route::get('email/destroy/{id}', 'Admin\EmailController@delete')->name('admin_email_delete'); // in addition to DELETE action
    Route::resource('email', 'Admin\EmailController');
  });

  /* MEDIA HIGHLIGHTS */
  Route::group(['middleware' => ['mediahighlights']], function () {
    Route::get('mediahighlights', 'Admin\MediaHighlightController@index')->name('media_highlights_list');
    Route::get('mediahighlights/{id}/edit', 'Admin\MediaHighlightController@edit')->name('media_highlights_edit');
    Route::get('mediahighlights/form', 'Admin\MediaHighlightController@form')->name('media_highlights_form');
    Route::get('mediahighlights/{id}/destroy', 'Admin\MediaHighlightController@destroy')->name('media_highlights_destroy');
  });

  Route::get('user/{user}/edit', 'Admin\UserController@edit')->name('admin_user_edit');
  Route::post('user/{user}/addMediafileUser', 'Admin\MediafileController@addMediafileUser')->name('store_mediafile_user');
  Route::post('user/{user}/updateMediafileUser', 'Admin\MediafileController@updateMediafileUser')->name('update_mediafile_user');
  Route::delete('user/{user}/removeMediafileUser', 'Admin\MediafileController@removeMediafileUser')->name('remove_mediafile_user');
  Route::get('user/{user}/confirm', 'Admin\UserController@confirm')->name('admin_user_confirm');
  Route::delete('user/{user}/destroy', 'Admin\UserController@destroy')->name('admin_user_destroy');
  Route::put('user/{user}/update', 'Admin\UserController@update')->name('admin_user_update');
  Route::post('user/store', 'Admin\UserController@store')->name('admin_user_store');
  Route::get('user/form', 'Admin\UserController@form');
  Route::resource('user', 'Admin\UserController');

  Route::patch('mediafile/{mediafile}/update', 'Admin\MediafileController@update')->name('admin_mediafile_update');
  Route::resource('mediafile', 'Admin\MediafileController');

  Route::get('announcement/archives', 'Admin\AnnouncementController@archives')->name('admin.announcement.archives');
  Route::get('announcement/queue/{atype?}', 'Admin\AnnouncementController@queue')->name('admin.announcement.queue');
  Route::get('announcement/form/{atype?}', 'Admin\AnnouncementController@form')->name('admin.announcement.form');
  Route::get('announcement/{id}/unarchive', 'Admin\AnnouncementController@unarchive')->name('admin.announcement.unarchive');

  Route::resource('announcement', 'Admin\AnnouncementController');

  Route::get('event/queue', 'Admin\EventController@queue')->name('admin.event.queue');
  Route::get('/lbcqueue', 'Admin\EventController@lbcqueue')->name('admin.event.lbcqueue');
  Route::get('/hscqueue', 'Admin\EventController@hscqueue')->name('admin.event.hscqueue');
  Route::get('event/form', 'Admin\EventController@form')->name('admin.event.form');
  Route::resource('event', 'Admin\EventController');

  // Archives
  Route::get('archive/queue/{entityType}', 'Admin\ArchiveController@queue')->name('admin.archive.queue');
  Route::resource('archive', 'Admin\ArchiveController');

  Route::get('page/edit/{page}', 'Admin\PageController@edit')->name('admin_page_edit');
  Route::put('page/update/{page}', 'Admin\PageController@update')->name('admin_page_update');
  Route::get('page/destroy/{id?}', 'Admin\PageController@destroy')->name('admin_page_destroy');
  Route::get('page/form', 'Admin\PageController@form')->name('admin_page_form');
  Route::post('page/delete', 'Admin\PageController@delete')->name('admin_page_delete');
  Route::post('page/store', 'Admin\PageController@store')->name('admin_page_store');
  Route::get('page/index', 'Admin\PageController@index')->name('admin_page_index');
  Route::resource('page', 'Admin\PageController');


  Route::get('magazine/{magazine}/edit', 'Admin\MagazineController@edit')->name('admin_magazine_edit');
  Route::put('magazine/{magazine}/update', 'Admin\MagazineController@update')->name('admin_magazine_update');
  Route::get('magazine/delete/{id?}', 'Admin\MagazineController@delete')->name('admin_magazine_update');
  Route::post('magazine/{magazine}/addCoverImage', 'Admin\MagazineController@addCoverImage')->name('store_magazine_cover');
  Route::put('magazine/{mediafile}/updateCoverImage/', 'Admin\MagazineController@updateCoverImage')->name('update_magazine_cover');
  Route::get('magazine/delete/{id?}', 'Admin\MagazineController@delete')->name('admin_magazine_delete');
  Route::get('magazine/form', 'Admin\MagazineController@form')->name('admin_magazine_form');
  Route::get('magazine/archives', 'Admin\MagazineController@archives')->name('admin_magazine_archives');
  Route::post('magazine/store', 'Admin\MagazineController@store')->name('admin_magazine_store');
  Route::get('magazine', 'Admin\MagazineController@index')->name('admin_magazine_index');

  Route::patch('storyimage/{storyimage}/update', 'Admin\StoryImageController@update')->name('admin_storyimage_update');
  Route::delete('storyimage/{storyimage}/delete', 'Admin\StoryImageController@destroy')->name('admin_storyimage_destroy');

  Route::resource('storyimages', 'Admin\StoryImageController');

  Route::post('promotestory', 'Admin\StoryController@promoteStory')->name('admin_promotestory');
  Route::put('story/{id}/updatefrompreview', 'Admin\StoryController@updateFromPreview')->name('admin_preview_story_update');
  // CP 2/25/22
  Route::post('demotestory', 'Admin\StoryController@demoteStory')->name('admin_story_demote');

  Route::post('{qtype}/{gtype}/{stype}/{story}/addnewstoryimage', 'Admin\StoryImageController@addNewStoryImage')->name('admin_storyimage_add_new_storyimage');
  Route::get('storyimage/{storyimage}/confirm', 'Admin\StoryImageController@confirm')->name('admin_storyimage_confirm');

  Route::resource('mediafile', 'Admin\MediafileController');
  Route::resource('role', 'Admin\RoleController');
  Route::resource('permission', 'Admin\PermissionController');

  // EMU 175
  Route::resource('emu175', 'Admin\EMU175Controller');

	// Intcomm Posts
	Route::get('intcomm', 'Admin\IntcommController@dashboard')->name('admin_intcomm_dashboard');
	Route::resource('intcomm/ideas', 'Admin\IntcommIdeaController');
	Route::resource('intcomm/posts', 'Admin\IntcommPostController');

  Route::get('story/queueall', 'Admin\StoryTypeController@queueAll')->name('admin_story_queue');
  Route::get('magazine/article/queuearticle', 'Admin\StoryTypeController@queueArticle')->name('admin_magazine_article_queue');

  Route::get('story/{stype}/queueall', 'Admin\StoryTypeController@queueAll')->name('admin_storytype_queueall');

  Route::get('magazine/article/setup', 'Admin\StoryTypeController@articleSetup')->name('admin_magazine_article_setup');

  Route::get('magazine/{stype}/{story}/edit', 'Admin\StoryTypeController@storyTypeEdit')->name('admin_magazine_article_edit');
  Route::get('story/{stype}/setup', 'Admin\StoryTypeController@storyTypeSetUp')->name('admin_storytype_setup');


  Route::get('{gtype}/{stype}/{qtype}', 'Admin\StoryTypeController@queue');

  Route::get('{qtype}/{gtype}/{stype}/form', 'Admin\StoryTypeController@storyTypeForm');

  Route::get('{qtype}/{gtype}/{stype}/{story}/edit', 'Admin\StoryTypeController@storyTypeEdit')->middleware('bindings');
});
// ^^ END ADMIN ROUTES

Route::group(['prefix' => 'mediahighlights'], function () {
  Route::get('/', 'Today\MediaHighlightController@index')->name('mediahighlights_index');
});

Route::group(['prefix' => 'intcomm'], function () {
//  Route::get('/', 'Today\IntcommPostController@index')->name('intcomm_index');
//  Route::get('/', 'Today\IntcommPostController@index')->name('intcomm_index');
	Route::resource('/ideas', 'Today\IntcommIdeaController');
	Route::resource('', 'Today\IntcommController');
});
