<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author_id', 'description', 'imagePath', 'code'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function members(){
        return $this->belongsToMany(User::class, 'members');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function resources(){
        return $this->hasMany(Resource::class);
    }

    public function homework(){
        return $this->hasMany(Homework::class);
    }
}
