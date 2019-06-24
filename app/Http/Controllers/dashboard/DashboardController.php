<?php


namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
    public function index()
    {
        $countUsers = DB::table('users')->count();
        $countEvents = DB::table('poi')->count();
        $countReports = DB::table('event_reports')->count();

        $data = new DashboardController();

        $data->countUsers = $countUsers;
        $data->countEvents = $countEvents;
        $data->countReports = $countReports;
        return view('dashboard/dashboard', ['data' => $data]);
    }


}
