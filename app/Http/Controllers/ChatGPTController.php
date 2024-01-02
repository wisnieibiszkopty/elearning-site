<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
 *  guwno jebane
 *  nie chce przyjac mojego requesta api
 */

class ChatGPTController extends Controller {
    public function index(){
        return view('openai');
    }

    public function prompt(Request $request){

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('CHAT_GPT_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => "gpt-3.5-turbo",
            'messages' => [
                'role' => 'user',
                'content' => $request->post('content')
            ],
            'temperature' => 0,
            'max_tokens' => 2048
        ])->body();

        $chatResponse = $response;
        dd($chatResponse);

        return response()->json(json_decode($response));
    }
}
