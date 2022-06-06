<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'user_id', 'admin_id', 'support_id', 'description'
    ];
}
