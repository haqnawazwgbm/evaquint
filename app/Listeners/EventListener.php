<?php

namespace App\Listeners;

use App\Events\EventOpen;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Auth;
use Mail;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(EventOpen $event)
    {
        //Check the open spot notification record
        $hostNotification = DB::table('host_notifications')->where('poiID', $event->request->poiID)->where('hostID', Auth::user()->id)->where('type', 'guest')->where('readType', 'unread')->first();
        if (count($hostNotification) > 0) {
            $notification = "The ".$event->request->title." event is open and now you can join it.";

            $notificationID = DB::table('host_notifications')->where('hostNotificationID', $hostNotification->hostNotificationID)->update(
                [
                    'hostID' => $hostNotification->userID,
                    'userID' => $hostNotification->hostID,
                    'message' => $notification,
                    'notificationType' => 'Event Open',
                    'type' => 'host',
                    'readType' => 'unread',
                    'created_at' => date('Y/m/d H:i:s')
                ]
            );
        }
        
    }
}
