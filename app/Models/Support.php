<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use App\Models\Lesson;
use App\Models\ReplySupport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'status', 'description', 'user_id', 'lesson_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function replies() {
        return $this->hasMany(ReplySupport::class);
    }
}
