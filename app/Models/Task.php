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
        'comment'
    ];

    public function homework(){
        return $this->belongsTo(Homework::class);
    }
}
