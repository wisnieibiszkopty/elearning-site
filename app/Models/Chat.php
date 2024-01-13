<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function lastMessage(){
        return $this->hasOne(Message::class)->latest('created_at')->limit(1);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'chat_members');
    }
}
