<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'chat_member_id',
        'message',
        'readed'
    ];

    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
