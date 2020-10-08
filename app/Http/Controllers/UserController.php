<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function Authenticate(Request $request)
    {
        // Retrive Input
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // if success login
            $users = User::all();
            return view('home', compact('users'));

            //return redirect()->intended('/details');
        }
        // if failed login
        return Redirect::back()->withErrors(['msg' => 'Username or password does not exist!']);
    }

    public function AddUser(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        if($request->password !== $request->password_confirmation){
            return redirect()->back()->withErrors(['error' => 'confirm password is not matching']);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fullname' => $request->fullname,
                'phonenumber' => $request->phonenumber,
                'role' => $request->isteacher ? 2 : 1,
            ]);

            return redirect('/');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'username is already exist']);
        }

    }

    public function UpdateUser(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $user = User::find($request->userid);

        $user->name = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->fullname = $request->fullname;
        $user->phonenumber = $request->phonenumber;
        $user->role = $request->isteacher ? 2 : 1;

        $user->push();

        if(auth()->user()->id == $request->userid){
            Auth::login($user);
        }

        return redirect('/');
    }

    public function UpdateProfile(Request $request)
    {
        $user = User::find($request->userid);

        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->phonenumber = $request->phonenumber;

        $user->push();

        Auth::login($user);

        return redirect('/profile');
    }

    public function DeleteUser(Request $request){
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $user = User::find($request->userid);
        $user->forceDelete();

        return redirect('/');
    }

    public function DetailUser(Request $request){
        $user = User::find($request->userid);
        $messages = MessageController::GetSentMessage($request->userid);

        return view('detailuser', compact('messages','user'));
    }
}
