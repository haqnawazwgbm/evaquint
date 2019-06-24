<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Auth;


class NotificationController extends Controller
{

    /**
     * Show all notifications start from here.
     */
    public function allNotifications() {


        $notifications = DB::table('join_event')
                ->select('event_notifications.*')
                ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                ->where('join_event.user_id', '=', Auth::user()->id)
                ->where('type', 'unread')->get();
        $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('type', 'host')->get();
        $notifications = $notifications->merge($hostNotifications);
        //use laravel collection sort method to sort the collection by created_at
        $notifications = $notifications->sortByDesc('created_at');

        $notifications->totalNotifications = count($notifications);

        return view('allNotifications', ['notifications' => $notifications]);
    }

    /**
    * Delete host notification function
    */
    public function removeHostNotification(Request $request) {
    	DB::table('host_notifications')->where('hostNotificationID', '=', $request->hostNotificationID)->where('type', 'host')->delete();
    	echo 'true';
    }

    // Remove all  notification
    public function removeAllNotification() {
        DB::table('host_notifications')->where('userID', Auth::user()->id)->delete();
        return back();
    }

    /**
    * Read notification function
    *
    */
    public function readNotification(Request $request) {
        if ($request->type == 'host_notification') {
             DB::table('host_notifications')
            ->where('hostNotificationID', $request->id)->where('type', 'host')
            ->update(['readType' => 'read']);
        } else {
            DB::table('event_notifications')
            ->where('notificationID', $request->id)
            ->update(['type' => 'read']);
        }
         
    }

    /**
    * Unread notification function
    *
    */
    public function unReadNotification(Request $request) {
       if ($request->type == 'host_notification') {
        echo 'true';
             DB::table('host_notifications')
            ->where('hostNotificationID', $request->id)->where('type', 'host')
            ->update(['readType' => 'unread']);
        } else {
            DB::table('event_notifications')
            ->where('notificationID', $request->id)
            ->update(['type' => 'unread']);
        }
        
    }

    /**
    *Get new notification function
    *
    */
    public function getNewNotification(Request $request) {

        if ($request->type) {
            if ($request->hostNotificationID && $request->notificationID) {
                $notifications = DB::table('join_event')
                ->select('event_notifications.*')
                ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                ->where('join_event.user_id', '=', Auth::user()->id)
                ->where('type', 'unread')->where('notificationID', '>', $request->notificationID)->get();
                $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('hostNotificationID', '>', $request->hostNotificationID)->where('type', 'host')->get();

                $notifications = $notifications->merge($hostNotifications);
            } else {
                if ($request->hostNotificationID && !$request->notificationID) {
                    $notifications = DB::table('join_event')
                    ->select('event_notifications.*')
                    ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                    ->where('join_event.user_id', '=', Auth::user()->id)
                    ->where('type', 'unread')->get();
                     $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('hostNotificationID', '>', $request->hostNotificationID)->where('type', 'host')->get();
                } else {
                    if (!$request->hostNotificationID && $request->notificationID) {
                        $notifications = DB::table('join_event')
                        ->select('event_notifications.*')
                        ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                        ->where('join_event.user_id', '=', Auth::user()->id)
                        ->where('type', 'unread')->where('notificationID', '>', $request->notificationID)->get();
                      $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('type', 'host')->get();
                    } else {
                        $notifications = DB::table('join_event')
                        ->select('event_notifications.*')
                        ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                        ->where('join_event.user_id', '=', Auth::user()->id)
                        ->where('type', 'unread')->get();
                      $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('type', 'host')->get();
                    }
                }
                
            }

       } else {

            $notifications = DB::table('join_event')
                    ->select('event_notifications.*')
                    ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                    ->where('join_event.user_id', '=', Auth::user()->id)
                    ->where('type', 'unread')->get();

                $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('readType', 'unread')->where('type', 'host')->get();


               $notifications = $notifications->merge($hostNotifications);

       }

       //Insert notification before event start function.
       $this->insert_notification($request);


        
        return Response::json($notifications);
    }

    /* 
    * Notify me when spot when open function 
    */
    public function notifyMeWhenSpotOpen(Request $request) {
        if ($request->notification == 'true') {
               $notificationID = DB::table('host_notifications')->insertGetId(
                [
                    'userID' => Auth::user()->id,
                    'hostID' => $request->hostID,
                    'poiID'  => $request->poiID,
                    'type' => 'guest',
                    'readType' => 'unread',
                    'notificationType' => 'Event Open',
                    'created_at' => date('Y/m/d H:i:s')
                ]
            ); 
           } else {
            DB::table('host_notifications')->where('userID', Auth::user()->id)->where('hostID', $request->hostID)->where('poiID', $request->poiID)->where('type', 'guest')->where('readType', 'unread')->delete();
           }
         

    }

    /*
    * Read all notifications function
    */
    public function readAllNotifications() {
        DB::table('host_notifications')->where('hostID', Auth::user()->id)->update(['readType' => 'read']);

        // Get event notifications id's
         $notificationsID = DB::table('join_event')
                ->select('event_notifications.notificationID')
                ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                ->where('join_event.user_id', '=', Auth::user()->id)
                ->where('type', 'unread')->pluck('notificationID')->toArray();
                
        DB::table('event_notifications')->whereIn('notificationID', $notificationsID)->update([
            'type' => 'read'
            ]);
        echo true;
    } 

    /*
    * Insert notification before event start function.
    */
    public function insert_notification($request) {

        $joinEvents = DB::table('poi')
                    ->select('poi.dateTime', 'poi.title', 'poi.id as poiID','users.*','join_event.user_id')
                    ->join('join_event', function($join) {
                        $join->on('join_event.poiID', '=', 'poi.id')
                        ->where('join_event.starting_notification_sent', 'no');
                    })
                    ->join('users', 'join_event.user_id', '=', 'users.id')
                    ->where('poi.status', 'open')
                    ->where('poi.dateTime', '>=', $request->currentDate)
                    ->where('poi.dateTime', '<=', $request->incrementDate)
                   // ->where('poi.id',675)
                    ->get();
                    foreach($joinEvents as $joinEvent) {
                        $notification = "$joinEvent->title event will be start at $joinEvent->dateTime";
                        $notificationID = DB::table('host_notifications')->insertGetId(
                           [
                               'poiID' => $joinEvent->poiID,
                               'hostID' => $joinEvent->user_id,
                               'message' => $notification,
                               'readType' => 'unread',
                               'notificationType' => 'Event Starting Date',
                               'created_at' => date('Y/m/d H:i:s')
                           ]
                        );

                        
                        $emailcontent = array (
                            'subject' => 'Event Starting Date',
                            'notification' => $notification,
                            'link' => '/joinEvent/' . $joinEvent->poiID
                        );
                        Mail::send('mail.event', $emailcontent, function($message) use  ($email)
                        {
                            $message->from('haqnawazusp@gmail.com', 'Evaquint');
                            $message->to($email)->subject('Event Starting Date');
                        });

                        DB::table('join_event')->where('poiID', $joinEvent->poiID)->update([
                            'starting_notification_sent' => 'yes'
                            ]);
                    }

    }
}
