<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function show() {
        return Inertia::render('auth/Login');
    }

    public function checkLogin(Request $request) {
        $validated = $request->validate([
            'name' => ['required','max:255'],
            'password' => ['required', 'min:6','max:255']
        ]);

        $user = User::where('name',  $request->name)->first();
        if($user && Hash::check($request->password, $user->password)){
            return redirect()->intended('/')->with('userName', $request->name);
        }
        else{
            return back()->withErrors([
                'password' => 'Неверный логин или пароль.',
            ])->onlyInput('password');
        }
    }

  
    // public function auth(Request $request)
    // {

    //     if($request->input('action') == "enter")
    //     {
    //         $validated = $request->validate([
    //             'name' => 'required|max:255',
    //             'password' => 'required|min:6|max:255'
    //         ]);

    //         $user = User::where('name',  $request->name)->first();

    //         if($user && Hash::check($request->password, $user->password)){
    //             return redirect('/profile')->with('userName', $request->name);
    //         }
    //         else{
    //             return redirect('/profile')->with('error', "Неправильный пароль");
    //         }
    //     }
    //     else if($request->action == "reg")
    //     {
            
    //         $validated = $request->validate([
    //             'name' => 'required|max:255',
    //             'email'=> 'required',
    //             'password' => 'required|min:6|max:255'
    //         ]);

    //         $user = User::where('name',  $request->name)->first();

    //         if($user){
    //             return redirect('/profile')->with('error', "Такой пользователь уже существует"); 
    //         }
    //         else{
    //             User::create($validated);
    //             return redirect('/profile')->with('userName', $request->name); 
    //         } 
    //     }
    //     else
    //     {
    //         return Inertia::render('Error');
    //     }

        
    // }

    // public function profile()
    // {
    //     return Inertia::render('Profile');
    // }
}
