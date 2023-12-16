<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function register(): View{
        return view("registration");
    }

    public function login(): View{
        return view("login");
    }

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

    public function show($id): View{
        $user = User::find($id, ['id', 'name', 'email', 'company', 'role', 'avatarPath']);

        //$authUser = Auth::user();
        //dd($authUser);

        if($user){
            return view('user.show', ['user' => $user]);
        }

        abort(404);
    }

    public function edit($id): View{
        return view('user.update', ['id' => $id]);
    }

    public function avatar(Request $request, $id){
        $user = User::find($id);

        if($request->hasFile('avatar') && $user){
            // deleting old avatar if exists
            // it don't work actually
            $relativePath = 'public/' . $user->avatarPath;
            $fullpath = storage_path($relativePath);
            if(Storage::exists($fullpath)){
                Storage::delete($fullpath);
            }

            // storing new avatar
            $file = $request->file('avatar');
            $user->avatarPath = $file->store('avatars', 'public');
            $user->save();
            return redirect('/user/' . $id);
        }

        // add error message
        return redirect('/user/' . $id);
    }

    public function update(){

    }

    public function destroy(){

    }
}
