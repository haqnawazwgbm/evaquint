<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\User;
use Auth;


class ProfileController extends Controller
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
     * Show the application edit.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        return view('editProfile', ['users' => $users]);
    }
    /**
     * Get private profile start from here.
     *
     * @return \Illuminate\Http\Response
     */
/**
* Get basic info .
*/
    public function getBasicInfo() {
        $users = DB::table('users')->where('id', Auth::user()->id)->first();
        // Get rating and find it's average start from here.
        $rating = DB::table('rating')->where('userID', Auth::user()->id)->avg('rating');
        $users->rating =  round($rating, 2);

        // Get events for pie chart
        $pieEvents = DB::table('join_event')
            ->select(DB::raw('count(*) as row_count, poi.id'), 'poi.title', 'poi.dateTime', 'poi.id', 'event_types.*')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->join('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
            ->groupBy('poi.eventType')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'close')
            ->get();$users->pieEvents = $pieEvents;
            $users->pieEvents = $pieEvents;
        return view('profile.p_basicInfo', ['users' => $users]);
    }

    /* 
    * Get user created events.
    */
    public function getMyEvents() {
        // Get hosted created events start from here.
        $myEvents = DB::table('poi')
            ->where('poi.user_id', '=', Auth::user()->id)
            ->paginate(5);
        foreach ($myEvents as $myEvent) {
            $myEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $myEvent->id)->get();
            $myEvent->rating = DB::table('rating')->select('rating.rating')->where('poiID', $myEvent->id)->avg('rating');
        }

        return view('profile.p_myEvents', ['myEvents' => $myEvents]);
    }
    /*
    * Get user friends.
    */
    public function getMyFriends()  {
         // Get friends start from here.
        $friends = DB::table('friends')
            ->select('users.*', 'friends.*')
            ->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friend_accepted', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)->paginate(5);;
        $friends->totalFriends = count($friends);
        return view('profile.p_myFriends', ['friends' => $friends]);
    }

    /*
    * Get user attended events.
    */
    public function getMyAttendedEvents() {
        // Get attended event of specific user
        $attendedEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'close')
            ->paginate(5);
        foreach ($attendedEvents as $attendedEvent) {
            $attendedEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendedEvent->id)->get();
        }
        return view('profile.p_myAttendedEvents', ['attendedEvents' => $attendedEvents]);
    }

    /*
    * Get user attending events.
    */
    public function getMyAttendingEvents() {
        // Get attending events of specific user
        $attendingEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'open')
            ->paginate(5);
        foreach ($attendingEvents as $attendingEvent) {
            $attendingEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendingEvent->id)->get();
        }
        return view('profile.p_myAttendingEvents', ['attendingEvents' => $attendingEvents]);
    }

    /*
    * Get user notification settings.
    */
    public function getMyNotificationSettings() {
        return view('profile.p_myNotificationSettings'); 
    }

    /*
    * Get user infor for updatioon .
    */
    public function getMyUpdateInfo() {
        $users = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('profile.p_myUpdateInfo', ['users' => $users]);
    }
    /*
    * Get user profile picture.
    */
    public function getMyProfilePicture() {
        $users = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('profile.p_myProfilePicture', ['users' => $users]);
    }

    /*
    * Get user account password.
    */
    public function getMyPassword() {
        return view('profile.p_myPassword');
    }

 
    /*
    * Get public profile basic info.
    */
    public function getPublicBasicInfo($id) {
        $users = DB::table('users')->where('id', $id)->first();
        // Get rating and find it's average start from here.
        $rating = DB::table('rating')->where('userID', $id)->avg('rating');
        $users->rating =  round($rating, 2);
        $friend = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'yes')
                        ->where('host_id', $id)->get();
        if (count($friend) > 0) {
            $users->friend = 1;
        } else {
            $friend = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'no')
                        ->where('host_id', $id)->get();
            if (count($friend) > 0)
                $users->friend = 2;
            else 
                $users->friend = 3;
        }
        // Get events for pie chart
        $pieEvents = DB::table('join_event')
            ->select(DB::raw('count(*) as row_count, poi.id'), 'poi.title', 'poi.dateTime', 'poi.id', 'event_types.*')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->join('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
            ->groupBy('poi.eventType')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'close')
            ->get();
        $users->pieEvents = $pieEvents;
        return view('profile.pub_basicInfo', ['users' => $users]);
    }

    /**
    * Get public attended events for public profile.
    */
    public function getPublicAttendedEvents($id) {
        // Get attended event of specific users
        $attendedEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', $id)
            ->where('poi.viewType', 'public')
            ->paginate(5);
        foreach ($attendedEvents as $attendedEvent) {
            $attendedEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendedEvent->id)->get();
        }
        return view('profile.pub_attendedEvents', ['attendedEvents' => $attendedEvents]);
    }

    /**
    * Get public attending events for public profile.
    */
    public function getPublicAttendingEvents($id) {
        // Get attending events of specific user
        $attendingEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'open')
            ->where('poi.viewType', 'public')
            ->paginate(5);
        foreach ($attendingEvents as $attendingEvent) {
            $attendingEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendingEvent->id)->get();
        }
        return view('profile.pub_attendingEvents', ['attendingEvents' => $attendingEvents]);
    }
    /**
     * Get public events start from here.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPublicProfile($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        // Get rating and find it's average start from here.
        $rating = DB::table('rating')->where('userID', $id)->avg('rating');
        $users->rating =  round($rating, 2);

        // Get attended event of specific user
        $attendedEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', $id)
            ->where('poi.viewType', 'public')
            ->get();
        foreach ($attendedEvents as $attendedEvent) {
            $attendedEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendedEvent->id)->get();
        }

         // Get attending events of specific user
        $attendingEvents = DB::table('join_event')
            ->select('poi.title', 'poi.dateTime', 'poi.id')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'open')
            ->where('poi.viewType', 'public')
            ->get();
        foreach ($attendingEvents as $attendingEvent) {
            $attendingEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $attendingEvent->id)->get();
        }

        // Get hosted created events start from here.
        $myEvents = DB::table('poi')
            ->where('poi.user_id', '=', $id)
            ->where('poi.viewType', 'public')
            ->get();
        foreach ($myEvents as $myEvent) {
            $myEvent->eventImages = DB::table('event_images')->select('event_images.path')->where('poiID', $myEvent->id)->get();
            $myEvent->rating = DB::table('rating')->select('rating.rating')->where('poiID', $myEvent->id)->avg('rating');
        }

        // $eventImages = DB::table('event_images')->where('userID', Auth::user()->id)->get();
        $users->myEvents = $myEvents;
        $users->attendedEvents = $attendedEvents;
        $friend = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'yes')
                        ->where('host_id', $id)->get();
        if (count($friend) > 0) {
            $users->friend = 1;
        } else {
            $friend = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'no')
                        ->where('host_id', $id)->get();
            if (count($friend) > 0)
                $users->friend = 2;
            else 
                $users->friend = 3;
        }

        $users->attendingEvents = $attendingEvents;
         // Get events for pie chart
        $pieEvents = DB::table('join_event')
            ->select(DB::raw('count(*) as row_count, poi.id'), 'poi.title', 'poi.dateTime', 'poi.id', 'event_types.*')
            ->join('poi', 'join_event.poiID', '=', 'poi.id')
            ->join('event_types', 'poi.eventType', '=', 'event_types.event_type_id')
            ->groupBy('poi.eventType')
            ->where('join_event.user_id', '=', Auth::user()->id)
            ->where('poi.status', 'close')
            ->get();
        $users->pieEvents = $pieEvents;

        return view('publicProfile', ['users' => $users]);
    }

    /**
     * Update the application edit.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $data)
    {
        $this->validate($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = user::findOrFail($data->id);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->save();
        $data->session()->flash(
                'status',
                "Profile updated successfully"
            );


        return redirect('/profile/myUpdateInfo');
    }

    /**
     * Delete the application user.
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();

        return redirect('/dashboard');
    }

    /**
     * Update user profile picutre start from here.
     */
    public function updateProfilePicture(Request $request) {
        DB::table('users')->where('id', $request->userID)->update(
            ['user_picture' => $request->image
            ]
        );

        $request->session()->flash(
                'status',
                "Profile picture updated successfully."
            );
        return redirect('/profile/myProfilePicture');
    }

    /**
     * Show public profile start from here.
     */
    public function publicProfile() {
        return view('/publicProfile');
    }

    /**
    * Notification settings function.
    */
    public function updateNotificationSettings(Request $request) {
        DB::table('users')->where('id', Auth::user()->id)
            ->update(
                [
                    'notify_by_email' => $request->notify_by_email,
                    'notify_by_phone' => $request->notify_by_phone,
                    'before_hours' => $request->before_hours
                ]
            );
    }
  


}