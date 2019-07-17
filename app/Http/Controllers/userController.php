<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserLevel;
use Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Exception;

class userController extends Controller
{
    //
    function login()
    {
        return view('login');
    }

    function register()
    {
        $user = Auth::user();
        $level = Auth::user()->level;

        $data = UserLevel::where('priority', '>', $level->priority)->get();
        return view('register')->with(compact('data'));
    }

    function logout(){
        Auth::logout();
        return view('login');
    }

    function getUserList(){
        $user = Auth::user();
        $level = Auth::user()->level;
        $data = User::join('user_levels', 'user_levels.id', '=', 'users.level_id')
            ->where('user_levels.priority', '>', $level->priority)
            ->select('users.id', 'users.name', 'users.user_status', 'users.email', 'user_levels.priority')
            ->paginate(15);
        return view('userlist')->with(compact('data'));
    }

    function getUserById(Request $id){
        
        $data   = User::find($id)->first();
        $ulevel = $data->level;
        $alevel = Auth::user()->level;
        
        if($alevel->priority < $ulevel->priority){
            $isdelete = true;
        }else{
            $isdelete = false;
        }
        
        return view('userprofile')->with(compact('data', 'isdelete'));
    }

    function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:3',
        ]);

        $user_data = array(
            'email'         => $request->get('email'),
            'password'      => $request->get('password'),
            'user_status'   => true,
        );

        if (Auth::attempt($user_data)) {
            return redirect('/');
        } else {
            return back()->with('error', 'Wrong email or password!');
        }
    }

    function addUser(Request $request){
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
            'name'      => 'required',
            'level_id'  => 'required',
        ]);

        try{
            $user               =   new User();
            $user->name         =   trim($request->input('name'));
            $user->email        =   trim($request->input('email'));
            $user->password     =   Hash::make(trim($request->input('password')));
            $user->level_id     =   trim($request->input('level_id'));
            $user->save();
            $message = $user->name.' register success !!!! ';
        }catch(Exception $e){
            $message = $e;
        }
        return redirect('employee/list')->with(compact('message'));
    }

    function updateUser(Request $request){
        $user_id            =   $request->input('user_id');
        try{
            $user               =   User::find($user_id);
            $user->name         =   trim($request->input('name'));
            $user->email        =   trim($request->input('email'));
            if($request->input('password') == $user->password){
                $user->password =   $user->password;
            }else{
                $user->password =   Hash::make(trim($request->input('password')));
            }
            $user->level_id     =   $request->input('level_id');
            $user->user_status  =   $request->input('user_status');
            $user->save();
            $message = 'Update Success !!!';
        }catch(Exception $e){
            $message = $e;
        }
        return redirect('employee/profile?id='.$user_id )->with(compact('message'));
    }

    function deleteUser(Request $request){
        $user_id                =   $request->input('user_id');
        
        try{
            $user               =   User::find($user_id);
            $user->name         =   $user->name;
            $user->email        =   $user->email ;
            $user->password     =   $user->password ;
            $user->level_id     =   $user->level_id;
            $user->user_status  =   false;
            $user->save();
            return redirect('/employee/list');
        }catch(Exception $e){
            $message = $e;
        }
    }

    public function check()
    {
        $userAuth = auth()->user();
        if($userAuth){
            return view('home');
        }else{
            return redirect('/login');
        }
    }

}
