<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'author_id',
        'content',
        'edited'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
