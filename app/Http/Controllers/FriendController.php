<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\POI;
use Auth;

class FriendController extends Controller
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
     * Get all friends function.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFriends()
    {
        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();

        return Response::json($friends);
        
    }

    /**
    * Get unregistered friends function.
    *
    */
    public function getUnregisterFriends($poiID)
    {
        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->whereNotIn( 'users.id', DB::table('join_event')->where('poiID', $poiID)->pluck('join_event.user_id'))
            ->where('users.id', '!=', 'join_event.user_id')->get();

        return Response::json($friends);
    }

      /**
     * Add friend function start from here.
     *
     */
    public function friend(Request $request) {
        $id = DB::table('friends')->insertGetId(
            ['guest_id' => $request->guest_id,
                'host_id' => $request->host_id,
                'friend_accepted' => 'no'
            ]
        );
        echo $id;
    }

    /**
     *Remove friend function start from here.
     *
     */
    public function unFriend($id) {
        DB::table('friends')->where('host_id', $id)->where('guest_id', Auth::user()->id)->delete();
        DB::table('friends')->where('guest_id', $id)->where('host_id', Auth::user()->id)->delete();
        echo 'true';
    }

    /**
     *
     * Accept or reject friend function start from here.
     */
    public function friendRequest(Request $request) {

        if ($request->decision == 'yes') {
            DB::table('friends')->where('guest_id', $request->guest_id)->where('host_id', Auth::user()->id)->update([
                'friend_accepted' => $request->decision
            ]);
                DB::table('friends')->insert(
                ['guest_id' => Auth::user()->id,
                    'host_id' => $request->guest_id,
                    'friend_accepted' => 'yes'
                ]
                );
        } else {
            DB::table('friends')->where('guest_id', $request->guest_id)->where('host_id', Auth::user()->id)->delete();
        }

        echo 'true';
    }

   
    /*
    * Get friend request function start from here.
    */
    public function getFrinedRequest(Request $request) {
            $friendRequest = DB::table('friends')
                ->select('users.*', 'friends.*')
                ->join('users', 'users.id', '=', 'friends.guest_id')
                ->where('friend_accepted', 'no')
                ->where('host_id', '=', Auth::user()->id);
                if ($request->friend_id)
                      $friendRequest =  $friendRequest->where('friend_id', '>', $request->friend_id)->get();
                else 
                     $friendRequest =  $friendRequest->get();
        
        if (isset($friendRequest)) {
            return Response::json($friendRequest);
        }

    }
   
}
