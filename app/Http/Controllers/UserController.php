<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(){
        return view("registration");
    }

    public function login(){
        return view("login");
    }

    public function create(){

    }

    public function auth(){

    }

    public function logout(){

    }

    public function store(Request $request){
        dd($request);

        $form = $request->validate([

        ]);

        User::create($form);
    }

    public function show(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
