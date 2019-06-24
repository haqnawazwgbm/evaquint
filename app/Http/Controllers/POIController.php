<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Mail;
//use App\POI;
use Auth;

class POIController extends Controller
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
     * Create the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
// open terminal 
        if (Auth::check()) {
           /* $path = 'img/default.png';
            if ($request->hasFile('eventPicture')) {
                $file = Input::file('eventPicture');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
                $path = 'uploads/' . $name;

            }
            //$dateTime = substr($request->dateTime, 0, -3);*/
            
            if ($request->image)
                $eventPicture = $request->image;
            else
                $eventPicture = '/img/default.png';
            $finishDate = date('Y-m-d', strtotime("+14 day"));

           // $dateTime = str_replace('/','-',$request->dateTime);
            $dateTime = substr($request->dateTime, 0, -3);
            if (count($request->invitedFriends) > 0) {
                $request->noOfAttendees = count($request->invitedFriends);
            }
            $id = DB::table('poi')->insertGetId(
                ['title' => $request->title,
                    'eventType' => $request->eventType,
                    'lat' => $request->lat,
                    'lon' => $request->lon,
                    'layerID' => 1,
                    'user_id' => Auth::user()->id,
                    'location' => $request->location,
                    'dateTime' => $dateTime,
                    'noOfAttendees' => $request->noOfAttendees,
                    'viewType' => $request->viewType,
                    'event_category_id' => $request->eventCategory,
                    'finishDate' => $finishDate,
                    'eventDescription' => $request->eventDescription,
                    'eventPicture' => $eventPicture
                ]
            );
            session()->flash('POI_id', $id);
            $data[0] = array(
                'id' => $id,
                'title' => $request->title,
                'path' => $eventPicture
            );

            //Register the host of event where event is created start from here.
            $getID = DB::table('join_event')->insertGetId(
                ['poiID' => $id,
                    'user_id' => Auth::user()->id,
                    'status' => 'join'
                ]
            );

            // Invite user process start from here.
            $request->id = $id;
            $this->inviteFriendsFunction($request);
           

            echo json_encode($data);

        } else {
            return redirect('/login');
        }
    }

    /**
    * Invite inviteFriendFunction function start from here
    */
    public function inviteFriendsFunction($request) {
         if ($request->inviteFriends) {
                foreach ($request->inviteFriends as $invitedFriend) {
                    $notification = Auth::user()->first_name.' '.Auth::user()->last_name.' Invited you for <a href="/joinEvent/'.$request->id.'">'.$request->title.'</a> Event
                    <br />
                        <div id="'.$request->id.'" class="btn btn-primary btn-small" title="$obj->title">Accept</div>
                        <div id="'.$request->id.'" class="btn btn-warning  btn-small">Reject</div>';  
                    $notificationID = DB::table('host_notifications')->insertGetId(
                        [
                            'poiID' => $request->id,
                            'message' => $notification,
                            'notificationType' => ucfirst($request->viewType).' Event Invitation',
                            'userID' => Auth::user()->id,
                            'hostID' => $invitedFriend,
                            'created_at' => date('Y/m/d H:i:s')
                        ]
                    );
                }
            }
            return true;

    }

    /**
     * Show the application edit.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $markers = DB::table('poi')->select('poi.*', 'event_types.*', 'event_categories.*')
                    ->join('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
                    ->join('event_categories', 'poi.event_category_id', '=', 'event_categories.event_category_id')->where('poi.id', $id)->get();
        $markers = json_encode($markers);
        echo $markers;
    }

    /**
     * Update the application edit.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
           /* $path = 'img/default.png';
            if ($request->hasFile('eventPicture')) {
                $file = Input::file('eventPicture');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
                $path = 'uploads/' . $name;
            }*/
			 //$dateTime = str_replace('/','-',$request->dateTime);
            $dateTime = substr($request->dateTime, 0, -3);
            $id = $request->markerID;
			$data = ['title' => $request->title,
                    'eventType' => $request->eventType,
                    'dateTime' => "$dateTime",
                    'noOfAttendees' => $request->noOfAttendees,
                    'eventType' => $request->eventType,
                    'event_category_id' => $request->eventCategory,
                    'viewType' => $request->viewType,
                    'eventDescription' => $request->eventDescription,
                    'eventPicture' => $request->image
                ];
				
            if (! $request->image)
                unset($data['eventPicture']);
			

           

            DB::table('poi')->where('id', $request->markerID)->update(
                $data
            );
            session()->flash('POI_id', $id);
            

            $joinedUsers = DB::table('join_event')
                ->select('users.email')
                ->join('users', 'users.id', '=', 'join_event.user_id')
                ->where('poiID', '=', $id)
                ->get();
            $notification = "Sorry for the inconvenience, your event has been Updated. And the new date time are $request->dateTime";
            $notificationID = DB::table('event_notifications')->insertGetId(
               [
                   'poiID' => $id,
                   'message' => $notification,
                   'notificationType' => 'Event Update',
                   'created_at' => date('Y/m/d H:i:s')
               ]
            );

            foreach ($joinedUsers as $key => $value) {
                $email = $value->email;
               /* Mail::raw($notification, function ($message) use ($email) {
                    $message->from('haqnawazusp@gmail.com', 'Fleek Mindgigs');
                    $message->to($email)->subject('Event Updated');
                });*/
                $emailcontent = array (
                    'subject' => 'Event Updated',
                    'notification' => $notification,
                    'link' => '/joinEvent/' . $id
                );
                Mail::send('mail.event', $emailcontent, function($message) use  ($email)
                {
                    $message->from('haqnawazusp@gmail.com', 'Evaquint');
                    $message->to($email)->subject('Event Updated');
                });
            }
            $data = DB::table('poi')->select('poi.*', 'event_types.*', 'event_categories.*')
                    ->join('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
                    ->join('event_categories', 'poi.event_category_id', '=', 'event_categories.event_category_id')
                    ->where('poi.id', $id)->get();
            return Response::json($data);

        } else {
            return redirect('/login');
        }
    }

    /**
     * Delete the application edit.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('poi')->where('id', '=', $id)->delete();
        DB::table('join_event')->where('poiID', '=', $id)->delete();
        echo 'deleted';
        $joinedUsers = DB::table('join_event')
            ->select('users.email')
            ->join('users', 'users.id', '=', 'join_event.user_id')
            ->where('poiID', '=', $id)
            ->get();
        $notification = "Sorry for the inconvenience, your event has been cancelled. Let\'s look for another event!";
        //Insert message into database.
        $notificationID = DB::table('event_notifications')->insertGetId(
           [
               'poiID' => $id,
               'message' => $notification,
               'notificationType' => 'Event Canceled',
               'created_at' => date('Y/m/d H:i:s')
           ]
            );

        foreach ($joinedUsers as $key => $value) {
            $email = $value->email;
            /*Mail::raw($notification, function ($message) use ($email) {
                $message->from('haqnawazusp@gmail.com', 'Fleek Mindgigs');
                $message->to($email)->subject('Event Canceled');
            });*/
            $emailcontent = array (
            'subject' => 'Event Canceled',
            'notification' => $notification,
            'link' => '/joinEvent/' . $id
            );
            Mail::send('mail.event', $emailcontent, function($message) use  ($email)
            {
                $message->from('haqnawazusp@gmail.com', 'Evaquint');
                $message->to($email)->subject('Event Canceled');
            });
        }
    }

    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function sendEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }

    /*
     * Close event function start from here.
     */
    public function closeEvent(Request $request) {
        $finishDate = date('Y-m-d', strtotime("+14 day"));

        DB::table('poi')->where('id', $request->poiID)->update([
             'status' => 'close'
        ]
        );

        $joinedUsers = DB::table('join_event')
            ->select('users.email')
            ->join('users', 'users.id', '=', 'join_event.user_id')
            ->where('poiID', '=', $request->poiID)
            ->get();
        $notification = $request->title." event has ended. Please rate the host and share your memories!";
        
        //Insert message into database.
        $notificationID = DB::table('event_notifications')->insertGetId(
            [
                'poiID' => $request->poiID,
                'message' => $notification,
                'notificationType' => 'Event Finished',
                'created_at' => date('Y/m/d H:i:s')
            ]
        );

        foreach ($joinedUsers as $key => $value) {
            $email = $value->email;
            /*Mail::raw($notification, function ($message) use ($email) {
                $message->from('haqnawazusp@gmail.com', 'Fleek Mindgigs');
                $message->to($email)->subject('Event Finished');
            });*/
            $emailcontent = array (
            'subject' => 'Event Finished',
            'notification' => $notification,
            'link' => $request->poiID
            );
            Mail::send('mail.event', $emailcontent, function($message) use  ($email)
            {
                $message->from('haqnawazusp@gmail.com', 'Evaquint');
                $message->to($email)->subject('Event Finished');
            });

        }

    }

    /**
    * Load event categories function start from here.
    *
    */
    public function eventCategories($id) {
        $eventCategories = DB::table('event_categories')->where('event_type_id', $id)->get();
        return Response::json($eventCategories);
    }

    /**
    * Invite friends from event view function start from here
    *
    */
    public function inviteFriends(Request $request) {
        $countInvitations = count($request->inviteFriends);
        $attendees = DB::table('join_event')->where('poiID', $request->id)->where('status', 'join')->count();
        $remainingCapacity = $request->noOfAttendees - $attendees;
        DB::table('host_notifications')->where('poiID', $request->id)->whereIn('userID', $request->inviteFriends)->whereIn('hostid', $request->inviteFriends);
        if ($countInvitations > $remainingCapacity && $request->viewType == 'public') {
            exit('false');

        }
        $this->inviteFriendsFunction($request);
        DB::table('poi')->where('id', $request->id)->update(
            [
                'noOfAttendees' => DB::raw("noOfAttendees + $countInvitations")
            ]);
        echo 'true';
    }


}
