<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Auth;


class SearchController extends Controller
{

    /**
     * Search event by title, descrition, interests.
     */
    public function searchEvent($text, $radius, $showRadius) {

        $markers = DB::table('poi')->where('title', 'like', '%'.$text.'%')
                 ->orWhere('eventDescription', 'like', '%'.$text.'%')
                 ->where('viewType', 'public')
                 ->orWhere('user_id', Auth::user()->id)->where('poi.status', 'open')->where('finishDate', '>=', date('Y-m-d'))->get();
        $markers->searchByEvent = "true";
        $markers->radius = $radius;
        $markers->showRadius = $showRadius;
        $friends = DB::table('friends')->select('users.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();
        $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
        $event_types = DB::table('event_types')->get();
        $markers->categories = $categories;
        $markers->event_types = $event_types;
        if (count($markers) > 0) {
            $markers->display = 'none';
        } else {
            $markers->display = 'block';
        }

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
        
        return view('map', ['markers' => $markers])->with('friends', $friends);
    }
     /**
     * Search people function start from here.
     */
    public function searchPeople(Request $request) {
        $users = DB::table('users')
            ->where(DB::raw('concat(first_name," ",last_name)') , 'LIKE' , "%$request->searchPeople%")
            ->orWhere(DB::raw('concat(first_name, last_name)') , 'LIKE' , "%$request->searchPeople%")
            ->orWhere('first_name', 'like', '%'.$request->searchPeople.'%')
             ->orWhere('last_name', 'like', '%'.$request->searchPeople.'%')->get();
        foreach ($users as $key => $user) {
            if ($user->id == Auth::user()->id) {
                unset($users[$key]);
            }

            $friend_accepted = DB::table('friends')
                    ->select('friends.friend_accepted')
                    ->where('guest_id', Auth::user()->id)
                    ->where('host_id', $user->id)->get();
            if (count($friend_accepted) > 0) {
               $friend_accepted = $friend_accepted[0]->friend_accepted;
            } else {
                $friend_accepted = 'null';
            }
            $user->friend_accepted = $friend_accepted;
        }

        $users->totalUsers = count($users);
        if ($users->totalUsers > 0) {
            $users->display = 'none';
        } else {
            $users->display = 'fixed';
        }
        return view('allPeople', ['users' => $users]);
    }

}
