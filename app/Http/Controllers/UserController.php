<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(){
        return view("registration");
    }

    public function login(){
        return view("login");
    }

    // avatarPath isn't set to null by default, change it later in migrations
    public function store(Request $request){
        $form = $request->validate([
            'name' => ['required'],
            'email' => [],
            'password' => ['required', 'confirmed'],
            'role' => [],
            'company' => []
        ]);

        $form['password'] = bcrypt($form['password']);
        $form['role'] = $form['role'] == 'student' ? 0 : 1;

        $user = User::create($form);
        auth()->login($user);

        return redirect('/courses');
    }

    public function auth(Request $request){
        $form = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($form)){
            $request->session()->regenerate();
            return redirect('/courses');
        }

        return redirect('/login');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function show($id){
        $user = User::find($id, ['id', 'name', 'email', 'company', 'role']);

        //$authUser = Auth::user();
        //dd($authUser);

        if($user){
            return view('user.show', ['user' => $user]);
        }

        abort(404);
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
