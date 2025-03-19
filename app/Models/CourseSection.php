<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends Model
{
    use  SoftDeletes;

    protected $fillable = [
       'name',
       'position',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
