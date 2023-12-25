<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'description',
        'available',
        'file_path',
        'finish_data'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
