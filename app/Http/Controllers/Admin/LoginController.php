<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class LoginController extends Controller {

    public function admin(Request $request)
    {
        $adminId = $request->session('admin');
        $admin = Admin::find($adminId);
        return $admin;
    }

      // toastr 
  public function toastr($refresh,$status,$icon,$title,$desc){
    $response = [
     'refresh'=>$refresh,
     'status'=>$status,
     'icon'=>$icon,
     'title'=>$title,
     'desc'=>$desc,
   ];
   echo json_encode($response);
   }
   // toastr 

    public function adminLogin (Request $request)
    { 
        $loginCheck = Admin::where(
            [
                ['email',$request->email],
                ['password',$request->password]
            ]
        )->first();

        if($loginCheck){
            $request->session()->put('admin',$loginCheck->admin_id);
            self::toastr(false,true,'success','Success','Login Successfull');
           
        }else{
            self::toastr(false,false,'error','Error','Incorrect Credentials');
        }
 

    }

    // adminLogout 
    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect('admin');

    }
    // adminLogout 

    // adminDashboard
    public function adminDashboard(Request $request )
    {
        $admin = Admin::find(session('admin'));
        return view('admin.dashboard.index',['admin'=>$admin]);

    }
    // adminDashboard

    // changeCredential
    
    public function changeCredential()
    {
         $admin = self::admin();
         return view('admin.dashboard.change_credential',['admin'=>$admin]); 

    }
    // changeCredential

}