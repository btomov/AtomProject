<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    public function editUser(Request $request) {
        $authUser = Auth::user();

        if(!$authUser) {
            return abort(403, 'Unauthorized action.');
        }
        // $userEmail = User::where('email', $request->email);
        // if($userEmail){
        //     return back()->withErrors('This email is already in use.');
        // }
        if($request->new_password){
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
                'email' => 'unique:users',
            ]);
        }
      
        $user = User::find($authUser->id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('successMessage', 'User edited successfully.');
    }
}