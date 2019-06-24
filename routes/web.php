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




Auth::routes();
//Social routes start from here.
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');

Route::get('/callback/{provider}', 'SocialAuthController@callback');

//Activation routes start from here.
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

// Authy routes start from here.


// User related routes


Route::post(
    '/user/create',
    ['uses' => 'UserController@createNewUser', 'as' => 'user-create', ]
);

Route::get(
    '/user/verify', ['as' => 'user-show-verify', function() {
        return response()->view('verifyUser');
    }]
);

Route::get('/delete_all_notification/', 'NotificationController@removeAllNotification');

Route::post(
    '/user/verify',
    ['uses' => 'UserController@verify', 'as' => 'user-verify', ]
);

Route::post(
    '/user/verify/resend',
    ['uses' => 'UserController@verifyResend',
     'as' => 'user-verify-resend']
);

Route::get('/user/verify/getresend', 'UserController@verifyResend');
// Authy routes end from here.

Route::group(['middleware' => ['revalidate']], function () {	

	Route::get('/readAllNotifications', 'NotificationController@readAllNotifications');

	Route::get('/dashboard/users', 'dashboard\UsersController@index');


	Route::get('/eventsByCategory/{id}', 'HomeController@eventsByCategory');

	Route::get('/dashboard/eventReports', 'dashboard\ReportController@listEventReports');

	Route::get('/dashboard/events', 'dashboard\EventsController@listEvents');

	Route::get('/dashboard/underTwoAndHalfStars', 'dashboard\EventsController@underTwoAndHalfStars');

	Route::get('/eSports', 'HomeController@eSports');
	
	Route::get('/getEventsForSmallMap', 'HomeController@getEventsForSmallMap');

	Route::get('/getFriends', 'FriendController@getFriends');
	
	Route::get('/getUnregisterFriends/{id}', 'FriendController@getUnregisterFriends');

	Route::get('/eventCategories/{id}', 'POIController@eventCategories');

	Route::get('/eventsTheUsual', 'HomeController@eventsTheUsual');
	
	Route::get('/eventsOthersAreDoing', 'HomeController@eventsOthersAreDoing');

	Route::get('/eventsCategories', 'HomeController@eventsCategories');

	Route::get('/allNotifications', 'NotificationController@allNotifications');

	Route::get('/', ['as' => 'user-index','uses' => 'HomeController@index']);

	Route::get('/map', 'HomeController@publicMap');

	Route::post('/disableCurrentLocation', 'JoinEventController@disableCurrentLocation');

	Route::get('/myActiveEvents', 'HomeController@myActiveEvents');

	Route::get('/myFinishedEvents', 'HomeController@myFinishedEvents');

	Route::get('/home', 'HomeController@index');

	Route::get('/map/{id}', 'HomeController@map');

	Route::get('/dashboard', 'dashboard\DashboardController@index');

	Route::get('/getProfile/{id}', 'ProfileController@index');

	Route::get('/profile/basicInfo', 'ProfileController@getBasicInfo');

	Route::get('/profile/myEvents', 'ProfileController@getMyEvents');

	Route::get('/profile/myFriends', 'ProfileController@getMyFriends');


	Route::get('/profile/myAttendedEvents', 'ProfileController@getMyAttendedEvents');

	Route::get('/profile/myAttendingEvents', 'ProfileController@getMyAttendingEvents');

	Route::get('/profile/myNotificationSettings', 'ProfileController@getMyNotificationSettings');

	Route::get('/profile/myUpdateInfo', 'ProfileController@getMyUpdateInfo');

	Route::get('/profile/myProfilePicture', 'ProfileController@getMyProfilePicture');

	Route::get('/profile/myPassword', 'ProfileController@getMyPassword');

	Route::post('/editProfile', 'ProfileController@update');

	Route::get('/publicProfile/basicInfo/{id}', 'ProfileController@getPublicBasicInfo');

	Route::get('/publicProfile/attendedEvents/{id}', 'ProfileController@getPublicAttendedEvents');

	Route::get('/publicProfile/attendingEvents/{id}', 'ProfileController@getPublicAttendingEvents');

	Route::get('/updateProfilePicture', 'ProfileController@updateProfilePicture');

	Route::get('/contactUs', 'ContactUsController@contact');

	Route::post('/sendMessage', 'ContactUsController@sendMessage');

	Route::get('{id}', 'ProfileController@destroy');

	Route::post('createMarker', 'POIController@create');

	Route::get('/editMarker/{id}', 'POIController@edit');

	Route::post('/updateMarker', 'POIController@update');

	Route::get('/deleteMarker/{id}', 'POIController@delete');

	Route::get('/joinEvent/{id}', 'JoinEventController@getEventDetial');

	Route::post('/joinRegister', 'JoinEventController@registerJoinEvent');

	Route::post('/joinUnegister', 'JoinEventController@unregisterJoinEvent');

	Route::post('/insertDiscussion', 'EventDiscussionController@insertDiscussion');

	Route::post('/getDiscussions', 'GetDiscussionController@getDiscussions');

	Route::post('/deleteDiscussion', 'EventDiscussionController@deleteDiscussion');

	Route::post('/deleteUserFromEvent', 'JoinEventController@deleteUserFromEvent');

	Route::post('/updateRating', 'JoinEventController@updateRating');

	Route::get('/searchEvent/{text}/{radius}/{showRadius}', 'SearchController@searchEvent');

	Route::post('/sliderImage', 'JoinEventController@sliderImage');

	Route::post('/closeEvent', 'POIController@closeEvent');

	Route::post('/friend', 'FriendController@friend');

	Route::get('/unFriend/{id}', 'FriendController@unFriend');

	Route::post('/friendRequest', 'FriendController@friendRequest');

	Route::post('/searchPeople', 'SearchController@searchPeople');

	Route::post('/removeHostNotification', 'NotificationController@removeHostNotification');

	Route::post('/changePassword', 'ChangePasswordController@changePassword');

	Route::post('/eventsByCategories', 'HomeController@eventsByCategories');

	Route::post('/inviteFriends', 'POIController@inviteFriends');

	Route::post('/readNotification', 'NotificationController@readNotification');
	
	Route::post('/unreadNotification', 'NotificationController@unreadNotification');

	Route::post('/getFrinedRequest', 'FriendController@getFrinedRequest');

	Route::post('/getNewNotification', 'NotificationController@getNewNotification');
	
	Route::post('/notifyMeWhenSpotOpen', 'NotificationController@notifyMeWhenSpotOpen');

	Route::post('/insertReport', 'dashboard\ReportBlockController@insertReport');

	Route::post('/verifyReport', 'dashboard\ReportController@verifyReport');

	Route::post('/insertUserReport', 'ReportBlockController@insertUserReport');

	Route::post('/blockUser', 'ReportBlockController@blockUser');

	Route::post('/updateNotificationSettings', 'ProfileController@updateNotificationSettings');


});

