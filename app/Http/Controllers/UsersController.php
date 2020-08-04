<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login(){
        return view('client.pages.users.login_register');
    }

    public function register(Request $request){
        if($request->isMethod('POST')) {
            $data = $request->all();
//        echo "<pre>";print_r($data);die();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                toastr()->error('email này đã đăng ký rồi', 'error', ['timeOut' => 5000]);
                return redirect()->back();
            } else {
//            echo "success";die();
                $user = new User();
                $user->name = $data['name'];
                $user->user_name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->role_id = 3;
                $user->save();

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);
                return redirect('/cart');
            }
            }
        }
    }

    public function logout(){
        Session::forget('frontSession');
        Auth::logout();
        return redirect()->route('index');
    }

    public function clientLogin(Request $request){
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            Session::put('frontSession',$data['email']);
            return redirect('/cart');
        }else{
            toastr()->error('sảy ra lỗi khi đăng nhập', 'error', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }

    public function account(Request $request){
        return view('client.pages.users.account');
    }

    public function changePassword(Request $request){
        $user_id = Auth::user()->id;
        if($request->isMethod('post')){
            $data = $request->all();
//            dd(bcrypt($data['old_pwd']));
            $user = User::find($user_id);
            if (Hash::check($data['old_pwd'],$user->password) ){
                $user->password = bcrypt($data['new_pwd']);
                $user->save();
                toastr()->success('thay đổi password thành công', 'success', ['timeOut' => 5000]);
                return redirect()->back();
            }else{
                toastr()->error('mật khẩu cũ không đúng', 'error', ['timeOut' => 5000]);
                return redirect()->back();
            }
        }
        return view('client.pages.users.change_password');
    }

    public function changeAddress(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
//        echo "<pre>";print_r($userDetails);die();
        if ($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->mobile = $data['mobile'];
            $user->save();
            toastr()->success('thay đổi địa chỉ thành công', 'success', ['timeOut' => 5000]);
            return redirect()->back();
        }
        $cities = City::get();
        return view('client.pages.users.change_address',compact('cities','userDetails'));
    }
}
