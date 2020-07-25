<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\User;
use Session;

class SendEmailController extends BaseController
{
    
   

    function index($id)
    {
        $item = User::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("users.index"));
        }
        
        return view("admin.users.edit_password", compact("item", "id"));
     
    }


    function send(Request $request, $id)
    {
       
        $data = array(
            'name'      =>  $request->name,
            'password'      =>  $request->password,
           
        );
        $email=$request->email;
        Mail::to($email)->send(new SendMail($data));
        return back()->with('success', 'تم تعديل كلمة المرور بنجاح و ارسال الايميل بكلمة المرور الجديدة!');
     
        
        $user->update(['password'=>bcrypt($request->password)]);
        $user->update(['email'=>$request->email]);
        $user->update(['name'=>$request->name]);
  
        Session::flash("msg","s: تمت عملية التعديل بنجاح");
        return redirect(route("users.index"));

        

     

    }

    
}

?>