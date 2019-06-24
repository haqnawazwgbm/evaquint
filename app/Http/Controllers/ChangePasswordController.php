<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;


class ChangePasswordController extends Controller
{

    /**
     * Check user credentials for password
     */
    public function admin_credential_rules(array $data)
    {
      $messages = [
        'current_password.required' => 'Please enter current password',
        'password.required' => 'Please enter password',
      ];

      $validator = Validator::make($data, [
        'current_password' => 'required',
        'password' => 'required|same:password',
        'password_confirmation' => 'required|same:password',     
      ], $messages);

      return $validator;
    } 

    /**
    * Change user passsword 
    *
    */
    public function changePassword(Request $request)
    {
      if(Auth::Check())
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())
        {
          return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
        }
        else
        {  
<<<<<<< HEAD
          $current_password = Auth::User()->password;  
          if(bcrypt($request_data['current_password']) == $current_password)
=======
          $old_password = Auth::User()->password;  
          if(password_verify($request_data['current_password'], $old_password))
>>>>>>> 2a3096a8cbf87757bd50c848bf67af61ec2fcf98
          {           
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = bcrypt(($request_data['password']));
            $obj_user->save(); 
            return "ok";
          }
          else
          {           
            $error = array('current_password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);   
          }
        }        
      }
      else
      {
        return redirect()->to('/');
      }    
    }
}
