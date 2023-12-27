<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'homework_id',
        'file_path',
        'filename',
        'sended_on_time',
        'comment'
    ];

    public function homework(){
        return $this->belongsTo(Homework::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
