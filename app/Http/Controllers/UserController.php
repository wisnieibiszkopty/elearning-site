<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PasswordRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(): View{
        return view("auth/registration");
    }

    public function login(): View{
        return view("auth/login");
    }

    public function store(Request $request){
        $rules = [
            'name' => ['required', 'min:6', 'max:32'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', new PasswordRule],
            'role' => ['required'],
            'company' => ['required', 'min:3', 'max:256']
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('/register')->withErrors($validator)->withInput();
        }

        $form = $validator->validate();

        $form['password'] = bcrypt($form['password']);
        $form['role'] = $form['role'] == 'student' ? 0 : 1;

        $user = User::create($form);
        auth()->login($user);

        return redirect('/course');
    }

    public function auth(Request $request){
        $form = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($form)){
            $request->session()->regenerate();
            return redirect('/course');
        }

        return redirect('/login')->withErrors(['form' => 'Invalid login data!']);
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function show($id): View{
        $user = User::find($id, ['id', 'name', 'email', 'company', 'role', 'avatarPath', 'created_at']);

        if($user){
            return view('user.show', ['user' => $user]);
        }

        abort(404);
    }

    public function edit($id): View{
        $user = User::find($id);
        return view('user.update', ['user' => $user]);
    }

    public function avatar(Request $request, $id){
        $user = User::find($id);

        if($request->hasFile('avatar') && $user){
            // deleting old avatar if exists
            // it don't work actually
            $path = $user->avatarPath;
            //dd(public_path($path));
            // if(file_exists(public_path($path))){
            //     unlink(public_path($path));
            // }

            // storing new avatar
            $file = $request->file('avatar');
            $user->avatarPath = $file->store('avatars', 'public');
            $user->save();
            return redirect('/user/' . $id);
        }

        // add error message
        return redirect('/user/' . $id);
    }

    // add message to back()
    public function password(Request $request){
        $passwordForm = $request->validate([
            'old-password' => ['required', new PasswordRule],
            'new-password' => ['required', 'confirmed', new PasswordRule]
        ]);

        $user = User::find(auth()->id());

        if(Hash::check($passwordForm['old-password'], $user->password)){
            $user->password = bcrypt($passwordForm['new-password']);
            $user->save();
            return back();
        }

        return back();
    }

    public function update(Request $request){
        $updateForm = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'min:3'],
            'company' => ['required', 'min:3']
        ]);

        $user = User::find(auth()->id());
        $user->name = $updateForm['name'];
        $user->email = $updateForm['email'];
        $user->company = $updateForm['company'];
        $user->save();

        return back();
    }

    public function destroy($id){
        if($id == auth()->id()){
            User::destroy($id);
            return redirect('/');
        }

        return redirect('/user/' . $id . "/edit");
    }
}
