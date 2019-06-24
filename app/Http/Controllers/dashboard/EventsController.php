<?php


namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class EventsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listEvents()
    {
        $markers = DB::table('poi')->get();

        return view('dashboard/listEvents', ['markers' => $markers]);
    }

    /**
    * Get under 2.5 stars rating function
    */
    public function underTwoAndHalfStars() {

        $markers = DB::table('poi')->select('poi.*')
            ->addSelect(DB::raw("avg('rating.rating') AS 'avg_rating'"))
            ->join('rating', 'rating.poiID', '=', 'poi.id')
            ->having('avg_rating', '<=', 2.5)
            ->where('finishDate', '>=', date('Y-m-d'))
            ->where('poi.status', 'open')->get();

        if (count($markers) <= 0) {
            Session::flash('info', 'There is no events under 2.5 star.');
        }


            return view('dashboard/listEvents', ['markers' => $markers]);

    }


}
