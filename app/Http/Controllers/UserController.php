<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginPage(){
        return Inertia::render('LoginPage');
    }
    public function registrationPage(){
        return Inertia::render('RegistrationPage');
    }
    public function userRegistration(Request $request){
       try{
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');
        $role=$request->input('role');
        User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'role'=>$role
        ]);
        $data=['message'=>'Registration Successful','status'=>true,'error'=>''];
        return redirect()->route('loginPage')->with($data);
       }catch(Exception $e){
          $data=['message'=>'Registration Failed','status'=>false,'error'=>$e->getMessage()];
          return redirect()->route('registrationPage')->with($data);
       }
    }
    public function userLogin(Request $request){

        $email=$request->input('email');
        $password=$request->input('password');
        //$role=$request->input('role');
        //$user = Auth::user();
        $count=User::where('email',$email)->where('password',$password)->select('id','role')->first();

        if($count!=null){
            $email=$request->input('email');
            $user_id=$count->id;
            $request->session()->put('email',$email);
            $request->session()->put('user_id',$user_id);
            $request->session()->put('role',$count->role);
            $data=['message'=>'Login Successful','status'=>true,'error'=>''];
            if ($count->role == 'admin') {

                return redirect("/DashboardPage");

                //return Inertia::render('DashboardPage');
            } else {
                return redirect("/DashboardPage1");
                //return Inertia::render('DashboardPage1')->with($data);
            }

        }
        else{
            $data=['message'=>'Registration Failed','status'=>false,'error'=>''];
            return redirect()->route('loginPage')->with($data);
        }
    }
    public function userLogout(Request $request){
        $request->session()->flush();
        return redirect()->route('loginPage');
    }
}
