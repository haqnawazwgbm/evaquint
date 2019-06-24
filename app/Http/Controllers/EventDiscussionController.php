<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Mail;
//use App\POI;
use Auth;


class EventDiscussionController extends Controller
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
     * Insert discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertDiscussion(Request $request)
    {
        $users =  DB::table('poi')
                ->where('user_id', '=', Auth::user()->id)
                ->where('id', '=', $request->poiID)
                ->get();

        if (count($users) > 0) {
            $userType = 'host';
        } else {
            $userType = 'guest';
        }

        $id = DB::table('discussion')->insertGetId(
            ['poiID' => $request->poiID,
                'userID' => Auth::user()->id,
                'discussion' => $request->discussion,
                'userType' => $userType,
                'dateTime' => date("Y-m-d H:i:s")
            ]
        );

        $user = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        $user[0]->userType = $userType;
        $user[0]->chatID = $id;

        echo json_encode($user);

    }
    /**
     * Delete discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteDiscussion(Request $request) {
        DB::table('discussion')->where('chatID', '=', $request->chatID)->delete();
        echo $request->chatID;
    }
}
