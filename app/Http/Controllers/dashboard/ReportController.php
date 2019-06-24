<?php


namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class ReportController extends Controller
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
    * List report function start from here.
    */
    public function listEventReports() {
        $reports = DB::table('event_reports')->select('users.*', 'poi.title','poi.id as poiID', 'event_reports.report_id', 'event_reports.description as reportDescription')
        ->join('users', 'users.id', '=', 'event_reports.reporter_id')
        ->join('poi', 'poi.id', '=', 'event_reports.poi_id')
        ->where('event_reports.status', 0)->get();

        return view('dashboard/listReports', ['reports' => $reports]);

    }

    /**
    * Verified report function start from here.
    */
    public function verifyReport(Request $request) {
        DB::table('event_reports')->where('report_id', $request->report_id)->update([
            'status' => 1
            ]);
        echo true;
    } 

}
