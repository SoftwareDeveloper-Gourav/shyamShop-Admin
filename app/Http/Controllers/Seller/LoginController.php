<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerModel;
use Crypt;

class LoginController extends Controller
{

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
    public function checkUsername($userName){
        $count = SellerModel::where('username',$userName)->first();

        if($count){
             $response = [
        'status'=>false,
        'title'=>'this username already exist, please use another username to sign up.'
       ];
        }else{
              $response = [
        'status'=>true,
        'title'=>'not exist'
       ];
       
        } 
          return $response;
    }
    
     public function checkEmail($email){
        $count = SellerModel::where('email',$email)->first();
        if($count){
            $response = [
                'status'=>false,
                'title'=>'This Email already exist , please use another email for sign up.'
            ];
        }else{
              $response = [
                'status'=>true,
                'title'=>'not exist'
            ];
        } 
        return $response;
     
    }
    
    // signup 
    public function signup(Request $request){
       $usernameExist =  $this->checkUsername($request->username);
      if($usernameExist['status']==true){
        $emailExist = $this->checkEmail($request->email);
        if($emailExist['status']==true){
            $signUp = new SellerModel;
            $signUp->username = $request->username; 
            $signUp->email = $request->email; 
            $signUp->password = encrypt($request->password); 
            $signUp->save();
            $request->session()->put('seller',$signUp->sellerId);
            $response = [
                'status'=>true,
                'title'=>'sign up successfully compleate'
            ];
            
        }else{
        $response = $emailExist;
        }
      }else{
        $response = $usernameExist;
      }
      echo json_encode($response);
    }
    // signup 
  
    // login 
    public function login(Request $request)
    {
      $username = $request->username;
      $password = $request->password;
      
      $usernameExist = SellerModel::where('email',$username)->orWhere('username',$username)->first();
      if($usernameExist){   
        $passwordCheck = decrypt($usernameExist->password) == $password;
        if($passwordCheck){
          $response = [
          'status'=>true,
          'title'=>'Login Successfull'
        ];
        $request->session()->put('seller',$usernameExist->sellerId);
        }else{
        $response = [
          'status'=>false,
          'title'=>'Incorrect Password , please try again !'
        ];
        }
      }else{
        $response = [
          'status'=>false,
          'title'=>'Incorrect username or email !'
        ];
      }
      echo json_encode($response);
      
    }
    // login 
    // sellerDashboard 
    public function sellerDashboard()
    {
      $sellerId = session('seller');
      $sellerData = SellerModel::find($sellerId);
      return view('seller.dashboard.index',['seller'=>$sellerData]);
    }
    // sellerDashboard 
    // logout
    public function logout(Request $request){
      $request->session()->forget('seller');
     return redirect('/seller/login');
      
    }
    // logout

    // changeCredential 
     public function changeCredential(Request $request)
     {
      $seller = SellerModel::find(session('seller'));
      $password = decrypt($seller->password);
      return view('seller.dashboard.credential.change_credential',['seller'=>$seller,'password'=>$password]);
     }

    // changeCredential 

    // updateCredential
    public function updateCredential(Request $request)
    {
     $email = $request->email;
     $username = $request->username;
     $password = $request->password;

     $updateCredential = SellerModel::find(session('seller'));
     $updateCredential->email=$email;
     $updateCredential->username=$username;
     $updateCredential->password=encrypt($password);
     $update = $updateCredential->save();
     $update?self::toastr(false,true,'success','Success','Credential Updated'):toastr(false,false,'error','Error','Credential Update Failed');
    }
    // updateCredential


}