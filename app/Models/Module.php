<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'course_id',
        'name'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}
