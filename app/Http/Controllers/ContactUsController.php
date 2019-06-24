<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use App\POI;
use Auth;
use Mail;

class ContactUsController extends Controller
{


    /**
     * Show the application event detial.
     *
     * @return \Illuminate\Http\Response
     */

    public function contact()
    {
            return view('contactUs');
    }

    /**
     * Send message start from here.
     */

    public function sendMessage(Request $request) {
        //$info = "Name: " . $request->name . " <br />Message: " . $request->message . "<br />Mail: " . $request->email;
     /*   $info='<table width="90%" border="0">
        <tr>
        <td><b>Name:</b></td> <td>'.$request->name.'</td>
        </tr>
        <tr>
        <td><b>Email:</b></td> <td>'.$request->message.'</td>
        </tr>
        <tr>
        <td><b>Message:</b></td> <td>'.$request->email.'</td>
        </tr>
        <tr></table>';
        Mail::raw($info, function ($message) {
            $message->from('haqnawazusp@gmail.com', 'Message');
            $message->to('haqnawazusp@gmail.com')->subject('Message');
        });*/
        $emailcontent = array (
            'email' => $request->email,
            'name' => $request->name,
            'subject' => 'Some one contact us.',
            'msg' => $request->messagetext
        );
        $emails = ['haqnawazwgbm@gmail.com', 'afnan_qu@hotmail.com', 'amrmahmoud.am@hotmail.com'];


        Mail::send('mail.contact', $emailcontent, function($message) use ($emails)
        {
            $message->from('haqnawazusp@gmail.com', 'Learning Evaquint Support');
            $message->to($emails,'Learning Evaquint Support')
                ->subject('Contact using Our Contact Form');
        });
        $request->session()->flash(
                'status',
                "Message sent successfully."
            );
        return view('contactUs');
    }
}