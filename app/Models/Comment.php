<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// need to run migrations again beacuse i forget to add timestamps
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author_id',
        'content'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
