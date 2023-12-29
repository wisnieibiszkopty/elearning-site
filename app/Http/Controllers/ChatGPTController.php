<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatGPTController extends Controller
{
    public function index(){
        return view('openai');
    }

    public function prompt(){

    }
}
