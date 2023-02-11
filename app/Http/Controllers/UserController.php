<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
class UserController extends Controller
{
    //

    public function create(){
       
        return view('users.register');
    }
    public function store(Request $request){
        $form = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
            
        ]);

        //hash password
        $form['password'] =bcrypt($form['password']);
        
        //create the user in model
        $user = User::create($form);

        //redirect to login page
        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully and logged in');
    }
    public function login(){
        return view('users.login');
    }
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Success.');
    }
    public function authenticate(Request $request){
        $form = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($form)){
            
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Authentication Success! Logged in!');
        }

        return back()->withErrors(["email"=>"Invalid Email", "password"=>"Invalid Password"]);
    }
}
