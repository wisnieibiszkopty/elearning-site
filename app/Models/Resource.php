<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [ 'course_id', 'name', 'file_path', 'file_size'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
