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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string', // se nao fizer esse cast, entende que o id é um numero
    ];
    
    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}
