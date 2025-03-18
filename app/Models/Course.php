<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{

    
    protected $fillable = [
        'name',
        'slug',
        'thubnail',
        'about',
        'is_popular',
        'category_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug( $value);
    }


    public function benefits():HasMany
    {
        return $this->hasMany(CourseBenefit::class);
    }
    public function courseSection():HasMany
    {
        return $this->hasMany(CourseSection::class);
    }
    public function courseStudent():HasMany
    {
        return $this->hasMany(CourseStudent::class);
    }

    public function courseMentors():HasMany
    {
        return $this->hasMany(CourseMentor::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function getContentCountAttribute()
    {
        return $this->courseSections()->sum(function ($section) {
            return $section->SectionContents->count();
        });
    }
}
