<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\POI;
use Auth;

class HomeController extends Controller
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
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markers = DB::table('poi')->where('finishDate', '>=', date('Y-m-d'))
            ->select('poi.title','poi.id as event_id', 'poi.eventPicture', 'poi.location', 'poi.eventDescription' , 'users.*')
            ->join('users', 'users.id', '=', 'poi.user_id')
            ->where('poi.status', 'open')->where('poi.viewType', 'public')->get();
        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();
        $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
        $event_types = DB::table('event_types')->get();
        $markers->categories = $categories;
        $markers->event_types = $event_types;
        //Check user rating.
        $markers->countRating = $this->checkUserRating($markers);
        return view('home', ['markers' => $markers])->with('friends', $friends);
    }

    /**
     * @param Show the application map
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publicMap() {
        $markers = DB::table('poi')->select('poi.*')
            //->join('friends', 'poi.user_id', '=', 'friends.host_id')
            ->where('finishDate', '>=', date('Y-m-d'))
            ->where('poi.status', 'open')->where('poi.viewType', 'public')
            //->where('friends.friend_accepted', 'yes')
            ->orWhere('poi.user_id', Auth::user()->id)->orWhereIn( 'poi.id', DB::table('host_notifications')->where('hostID', Auth::user()->id)->where('host_notifications.type', 'host')->pluck('host_notifications.poiID'))->distinct()->get();

        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();
        $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
        $event_types = DB::table('event_types')->get();
        $markers->categories = $categories;
        $markers->event_types = $event_types;
        //Check user rating.
    
        $markers->countRating = $this->checkUserRating($markers);
        return view('map', ['markers' => $markers])->with('friends', $friends);
    }

    /*
     * Show the specific event on map.
     */
    public function map($id) {
        $markers = DB::table('poi')->where('id', $id)->get();
        $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friends.friend_accepted', '=', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)->get();
        $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
        $event_types = DB::table('event_types')->get();
        $markers->categories = $categories;
        $markers->event_types = $event_types;
        //Check user rating.
        
        $markers->countRating = $this->checkUserRating($markers);
        return view('map', ['markers' => $markers])->with('friends', $friends);
    }

    /**
     * Show the open status events.
     *
     * @return \Illuminate\Http\Response
     */
    public function myActiveEvents()
    {
            if (Auth::check()) {
                 $id = Auth::user()->id;
                 $markers = DB::table('poi')->where('user_id', $id)->where('status', 'open')->get();
                 $friends = DB::table('friends')->select('users.*', 'friends.*')->join('users', 'friends.host_id', '=', 'users.id')
                    ->where('friends.friend_accepted', '=', 'yes')
                    ->where('friends.guest_id', '=', Auth::user()->id)
                    ->where('users.id', '!=', Auth::user()->id)->get();
                $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
                $event_types = DB::table('event_types')->get();
                $markers->categories = $categories;
                $markers->event_types = $event_types;
                //Check user rating.
                
                $markers->countRating = $this->checkUserRating($markers);
                 return view('myMap', ['markers' => $markers])->with('friends', $friends);
        }
    }

    /**
     * Show the close status events.
     *
     * @return \Illuminate\Http\Response
     */
    public function myFinishedEvents()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $markers = DB::table('poi')->where('user_id', $id)->where('status', 'close')->orWhere('finishDate', '<', date('Y-m-d'))->get();
            $categories = DB::table('event_categories')->where('event_type_id', 1)->get();
            $event_types = DB::table('event_types')->get();
            $markers->categories = $categories;
            $markers->event_types = $event_types;
            //Check user rating.
            
            $markers->countRating = $this->checkUserRating($markers);
            return view('myMap', ['markers' => $markers]);
        }
    }


    /*
    * Check user rating function
    */
    public function checkUserRating($markers) {
        $countRating = DB::table('rating')->where('userID', Auth::user()->id)->sum('rating');
            if ($countRating >= 1000) {
                $markers->btnTournament = '';
                $markers->tournamentModeTitle = '';
            } else {
                $markers->tournamentModeTitle = 'Need 1000 rank to make this event';
                $markers->btnTournament = 'btnTournament';
            }
        return $countRating;
    }


    /**
     * Create markers detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMarkerDetail(Request $request)
    {

        if (Auth::check()) {
                $dateTime = date('Y-m-d H:i:s', strtotime($request->dateTime));
                     DB::table('poi')
                    ->where('id', session()->get('POI_id'))
                    ->update(['title' => $request->title,
                        'eventType' => $request->eventType,
                        'location' => $request->location,
                        'dateTime' => $dateTime,
                        'noOfAttendees' => $request->noOfAttendees,
                        'viewType' => $request->viewType,
                        'eventDescription' => $request->eventDescription
                    ]);
                echo 'updated';
            } else {
                return redirect('/login');
        }


        }

        /**
        *Load the usual events function start from here.
        *
        */
        public function eventsTheUsual() {
            $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.Auth::user()->lat.') ) * cos( radians( poi.lat ) ) * cos( radians( poi.lon ) - radians('.Auth::user()->lng.') ) + sin( radians('.Auth::user()->lat.') ) * sin( radians( poi.lat ) ) ) ) ) AS distance');

             $markers = DB::table('poi')->where('finishDate', '>=', date('Y-m-d'))
            ->select('poi.title','poi.id as event_id', 'poi.eventPicture', 'poi.location', 'poi.eventDescription' , 'users.*')->addSelect($raw)
            ->join('users', 'users.id', '=', 'poi.user_id')
            ->where('poi.status', 'open')->where('poi.viewType', 'public')->where('poi.user_id', '!=', Auth::user()->id)->having('distance', '<', 50)->get();
        $users = DB::table('users')->get();
        $markers->users = $users;
        return view('eventsSlider', ['markers' => $markers]);
        }

        /**
        * Load event categories function start from here.
        *
        */
        public function eventsCategories() {
            $categories = DB::table('event_categories')->get();
        return view('eventsCategories', ['categories' => $categories]);
        }

        /**
        *Load the what others events function start from here.
        *
        */
        public function eventsOthersAreDoing() {
            $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.Auth::user()->lat.') ) * cos( radians( poi.lat ) ) * cos( radians( poi.lon ) - radians('.Auth::user()->lng.') ) + sin( radians('.Auth::user()->lat.') ) * sin( radians( poi.lat ) ) ) ) ) AS distance');

             $markers = DB::table('poi')
            ->select('poi.title','poi.id as event_id', 'poi.eventPicture', 'poi.location', 'poi.eventDescription' , 'users.*')->addSelect($raw)
            ->join('join_event', 'poi.id', '=', 'join_event.poiID')
            ->join('friends', function($join) {
                $join->on('join_event.user_id', '=', 'friends.host_id');
                $join->where('friends.guest_id', '=', Auth::user()->id);
                $join->where('friends.friend_accepted', '=', 'yes');
            })
            ->join('users', 'users.id', '=', 'poi.user_id')
            ->where('poi.status', 'open')->where('poi.viewType', 'public')->where('poi.user_id', '!=', Auth::user()->id)->having('distance', '<', 50)
            ->where('join_event.status', 'join')
            ->where('poi.finishDate', '>=', date('Y-m-d'))->distinct()->get();
        $users = DB::table('users')->get();
        $markers->users = $users;
        return view('eventsSlider', ['markers' => $markers]);
        }

        /**
        *Load event by categories function start from here.
        *
        */
        public function eventsByCategories(Request $request) {
                if (sizeof($request->category) == 0) {
                    $markers = array();
                } else {
                $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.Auth::user()->lat.') ) * cos( radians( poi.lat ) ) * cos( radians( poi.lon ) - radians('.Auth::user()->lng.') ) + sin( radians('.Auth::user()->lat.') ) * sin( radians( poi.lat ) ) ) ) ) AS distance');


                 $markers = DB::table('poi')->where('finishDate', '>=', date('Y-m-d'))
                ->select('poi.title','poi.id as event_id','poi.event_category_id', 'poi.eventPicture', 'poi.location', 'poi.eventDescription' , 'users.*')->addSelect($raw)
                ->join('users', 'users.id', '=', 'poi.user_id')
                ->where('poi.status', 'open')->where('poi.viewType', 'public')->whereIn('poi.event_category_id', $request->category)->where('poi.user_id', '!=', Auth::user()->id)->having('distance', '<', 50)->get();
                $users = DB::table('users')->get();
                $markers->users = $users;
                
            }
            return view('eventsSlider', ['markers' => $markers]);
        }

        /**
        *Load event slider by category function start from here.
        *
        */
        public function eventsByCategory($id) {

             $markers = DB::table('poi')->where('finishDate', '>=', date('Y-m-d'))
            ->select('poi.title','poi.id as event_id','poi.event_category_id', 'poi.eventPicture', 'poi.location', 'poi.eventDescription' , 'users.*')
            ->join('users', 'users.id', '=', 'poi.user_id')
            ->where('poi.status', 'open')->where('poi.viewType', 'public')->where('poi.event_category_id', $id)->where('poi.user_id', '!=', Auth::user()->id)->get();
            $users = DB::table('users')->get();
            $markers->users = $users;
            return view('eventsSlider', ['markers' => $markers]);
        }

        /**
        *Load events for small map function start from here.
        *
        */
        public function getEventsForSmallMap() {
            $markers = DB::table('poi')->select('poi.*')
            ->join('friends', 'poi.user_id', '=', 'friends.host_id')
            ->where('finishDate', '>=', date('Y-m-d'))
            ->where('poi.status', 'open')->where('poi.viewType', 'public')
            ->where('friends.friend_accepted', 'yes')
            ->orWhere('poi.user_id', Auth::user()->id)->get();
            return Response::json($markers);
        }

        /**
        *Load e-sports view page start from here
        *
        */
        public function eSports() {
            return view('eSports');
        }





}