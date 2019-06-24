<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\User;
use Auth;


class ReportBlockController extends Controller
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
     * Insert report into database
     */
    public function insertReport(Request $request) {
        DB::table('event_reports')->insert([
            'description' => $request->description,
            'reporter_id' => Auth::user()->id,
            'poi_id' => $request->poiID,
            'status' => 0
            ]);
        echo true;
        
    }
    /**
    * Insert user report function
    */
    public function insertUserReport(Request $request) {
        DB::table('user_reports')->insert([
            'description' => $request->description,
            'reporter_id' => Auth::user()->id,
            'user_id' => $request->user_id,
            'status' => 0
            ]);
        echo true;
    }
    /**
    * Block user function
    */
    public function blockUser(Request $request) {
         DB::table('block_users')->insert([
            'user_id' => $request->user_id,
            'blocker_id' => Auth::user()->id,
            'status' => 0
            ]);
        echo true;
    }

}
