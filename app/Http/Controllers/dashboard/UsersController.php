<?php


namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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
        $users = DB::table('users')->get();
        return view('dashboard/users', ['users' => $users]);
    }


}

