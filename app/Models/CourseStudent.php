<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseStudent extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'is_active',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
