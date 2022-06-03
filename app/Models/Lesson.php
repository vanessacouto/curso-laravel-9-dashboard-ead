<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string', // se nao fizer esse cast, entende que o id é um numero
    ];

    protected $fillable = [
        'module_id', 'name', 'description', 'url', 'video'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
