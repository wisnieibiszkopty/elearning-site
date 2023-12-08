<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'description', 'imagePath'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
