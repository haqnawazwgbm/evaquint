<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Events\EventOpen;
//use App\POI;
use Auth;
use Mail;
use Session;

class JoinEventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application event detial.
     *
     * @return \Illuminate\Http\Response
     */

    public function getEventDetial($id)
    {

             $markers = DB::table('poi')->join('users', 'users.id', '=', 'poi.user_id')
                            ->select('users.*', 'poi.*', 'event_categories.*', 'event_types.*', 'poi.status as markerStatus')
                            ->leftJoin('event_categories', 'poi.event_category_id', '=', 'event_categories.event_category_id')
                            ->leftJoin('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
                            ->where('poi.id', $id)->first();

            // Check event status. 
            if (date('Y-m-d', strtotime($markers->finishDate)) < date('Y-m-d', strtotime(date('Y-m-d')))) {
                $markerStatus = 'finished';
            } else {
                if ($markers->markerStatus == 'close') {
                    $markerStatus = 'closed';
                } else {
                    $markerStatus = 'open';
                }
            }
            $markers->markerStatus = $markerStatus;
                                      
            // Check if user is suspended from the current event
            $checkUserStatus = DB::table('join_event')->where('poiID', $id)->where('user_id', Auth::user()->id)->where('status', 'join')->get();
           
           
            $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
            $event_types = DB::table('event_types')->get();
            $markers->categories = $categories;
            $markers->event_types = $event_types;
            $alreadyJoin = DB::table('join_event')->where('poiID', '=', $id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('status', 'join')->get();
            $markers->alreadyJoin = count($alreadyJoin);

            $joinedUsers = DB::table('join_event')->join('users', 'users.id', '=', 'join_event.user_id')
                ->select('users.*', 'join_event.*')
                ->where('join_event.poiID', $id)
                ->where('status', '=', 'join')->get();
            $markers->joinedUsers = $joinedUsers;

            $discussions = DB::table('discussion')->join('users', 'users.id', '=', 'discussion.userID')
                            ->select('users.*', 'discussion.*')
                            ->where('discussion.poiID', $id)
                            ->orderBy('chatID','desc')->take(10)->get();
             $discussions = $discussions->reverse();
             $markers->discussions = $discussions;

            // Get event images from here.
            $eventImages = DB::table('event_images')->where('poiID', $id)->get();
            $markers->eventImages = $eventImages;

            // Get rating and find it's average start from here.
            $rating = DB::table('rating')->where('poiID', $id)->avg('rating');
            $markers->rating =  round($rating, 2);



            if ($markers->alreadyJoin > 0) {
                $markers->register = 'unregister';
                $markers->class = 'btn-danger';
                $markers->displayChat = '';
            } else {
                $markers->displayChat = 'hide';
                $markers->register = 'register';
                $markers->class = 'btn-success';
            }
    // if user status are unjoin then the register button will be disabled
            $unjoin = DB::table('join_event')->where('poiID', '=', $id)
                ->where('user_id', '=', Auth::user()->id)
                ->where('status', 'suspend')->get();
            if (count($unjoin) > 0) {
                $markers->disabled = 'disabled';
            } else {
                $markers->disabled = '';
            }

        if ($markers->user_id != Auth::user()->id && $markers->markerStatus == 'close' && $markers->alreadyJoin > 0) {
            $readOnly = 'false';
            $rateTitle = '';
        } else {
             if ($markers->user_id == Auth::user()->id) {
                 $readOnly = 'true';
                 $rateTitle = '';
             } else {
                 $readOnly = 'true';
                 $rateTitle = 'After event you can rate this host';
             }

         }


        $markers->rateTitle = $rateTitle;
        $markers->readOnly = $readOnly;
        if( $markers->user_id == Auth::user()->id) {
            $profileAccess = '/profile/basicInfo';
        } else {
            $profileAccess = '/publicProfile/'.$markers->user_id;
        }
        $markers->profileAccess = $profileAccess;

        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();
        $openSpotNotification = DB::table('host_notifications')->where('poiID', $markers->id)->where('hostID', $markers->user_id)->where('userID', Auth::user()->id)->where('type', 'guest')->where('readType', 'unread')->count();

        //Check user rating.
        $countRating = DB::table('rating')->where('userID', Auth::user()->id)->sum('rating');
        if ($countRating >= 1000) {
            $markers->btnTournament = '';
            $markers->tournamentModeTitle = '';
        } else {
            $markers->tournamentModeTitle = 'Need 1000 rank to make this event';
            $markers->btnTournament = 'btnTournament';
        }
        $markers->countRating = $countRating;

        // Calculat totla number host rank
        $markers->totalHostRank = $rating;
        $totalAttendees = DB::table('join_event')->where('status', 'join')->where('poiID', $id)->count();
        $verifiedReports = DB::table('event_reports')->where('poi_id', $id)->where('status', 1)->count();
        if ($totalAttendees > 10) {
            $markers->totalHostRank = $markers->totalHostRank + 50;
        }
        if ($rating >= 3) {
            $markers->totalHostRank = $markers->totalHostRank + 3;
        }
        if ($verifiedReports >= 100) {
            $markers->totalHostRank = $markers->totalHostRank - 100;
        }
        if ($markers->totalHostRank == null) {
            $markers->totalHostRank = 0;
        }

        $markers->openSpotNotification = $openSpotNotification;


                return view('joinEvent', ['markers' => $markers])->with('friends', $friends);

    }

    public function registerJoinEvent(Request $request)
    {

            $getID = DB::table('join_event')->insertGetId(
                ['poiID' => $request->poiID,
                    'user_id' => Auth::user()->id,
                    'status' => 'join'
                ]
            );
        $host = DB::table('poi')->select('users.*')->join('users', 'poi.user_id', '=', 'users.id')
                ->where('poi.id', $request->poiID)->first();

        $notification = Auth::user()->first_name." ".Auth::user()->last_name." joined $request->title event";
        $notificationID = DB::table('host_notifications')->insertGetId(
            [
                'userID' => Auth::user()->id,
                'poiID' => $request->poiID,
                'hostID' => $host->id,
                'message' => $notification,
                'notificationType' => 'Event Joined',
                'created_at' => date('Y/m/d H:i:s')
            ]
        );
       DB::table('host_notifications')->where('hostNotificationID', '=', $request->hostNotificationID)->delete();

        $email = $host->email;
       /* Mail::raw($notification, function ($message) use ($email) {
            $message->from('haqnawazusp@gmail.com', 'Fleek Mindgigs');
            $message->to($email)->subject('Event Joined');
        });*/

        $emailcontent = array (
            'subject' => 'Event Joined',
            'notification' => $notification,
            'link' => '/joinEvent/' . $request->poiID
        );
        Mail::send('mail.event', $emailcontent, function($message) use  ($email)
        {
            $message->from('haqnawazusp@gmail.com', 'Evaquint');
            $message->to($email)->subject('Event Joined');
        });

        echo $getID;

    }


    public function unregisterJoinEvent(Request $request)
    {

        DB::table('join_event')->where('poiID', '=', $request->poiID)->where('user_id', '=', Auth::user()->id)->delete();
        $notification = Auth::user()->first_name." ".Auth::user()->last_name." unregistered $request->title event";
        $notificationID = DB::table('host_notifications')->insertGetId(
            [
                'userID' => Auth::user()->id,
                'hostID' => $request->hostID,
                'poiID'  => $request->poiID,
                'message' => $notification,
                'notificationType' => 'Event Unregistered',
                'created_at' => date('Y/m/d H:i:s')
            ]
        );

       $email = $request->email;
       /*  Mail::raw($notification, function ($message) use ($email) {
            $message->from('haqnawazusp@gmail.com', 'Fleek Mindgigs');
            $message->to($email)->subject('Event Leaved');
        });*/
        $emailcontent = array (
            'subject' => 'Event Leaved',
            'notification' => $notification,
            'link' => '/joinEvent/' . $request->poiID
        );
        Mail::send('mail.event', $emailcontent, function($message) use  ($email)
        {
            $message->from('haqnawazusp@gmail.com', 'Evaquint');
            $message->to($email)->subject('Event Leaved');
        });

        echo $request->poiID;

    }
    /**
     * Remove guest from host event.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserFromEvent(Request $request)
    {
        /*DB::table('join_event')->where('joinEventID', $request->joinEventID)->update(
            [
                'status' => 'suspend'
            ]
        );*/
          // Fire an event where join event is open.
        event(new EventOpen($request));

        DB::table('join_event')->where('joinEventID', $request->joinEventID)->delete();

        $notification = "You have been removed from the event '$request->title''";

        $notificationID = DB::table('event_notifications')->insertGetId(
            [
                'poiID' => $request->poiID,
                'message' => $notification,
                'notificationType' => 'Removed From Event',
                'created_at' => date('Y/m/d H:i:s')
            ]
        );

        echo $request->joinEventID;

    }

    public function disableCurrentLocation(Request $request) {
        if ($request->show_current_location == 'no') {
                DB::table('users')->where('id', Auth::user()->id)->update(
                ['show_current_location' => 'no'
                ]
            );
                echo 'true';
        } else {
            DB::table('users')->where('id', $request->userID)->update(
            ['lat' => $request->lat,
                'lng' => $request->lng
                ]
            );
            Session::set('useCurrentLocation', 'notshow');
        }

       
    }

    /* Update rating value in users table.
     *
     */
    public function updateRating(Request $request) {

        $checkUser = DB::table('rating')
                    ->where('userID', $request->userID)
                    ->where('poiID', $request->poiID)->get();
        if (count($checkUser) > 0) {
            DB::table('rating')->where('userID', $request->userID)
                ->where('poiID', $request->poiID)
                ->update([
                'rating' => $request->rating]);
        } else {
            DB::table('rating')->insert([
                'poiID' => $request->poiID,
                'userID' => $request->userID,
                'rating' => $request->rating
            ]);
        }

        echo $request->rating;
    }

    /**
     * Upload slider images for event from here.
     */
    public function sliderImage(Request $request) {
        $eventImageID = DB::table('event_images')->insertGetId(
            [
                'poiID' => $request->poiID,
                'path' => $request->path,
                'userID' => $request->userID
            ]
        );

        echo $eventImageID;
    }
}
