<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait UuidTrait
{
    public static function booted() 
    {
        // antes de criar um registro com esse Model
        static::creating(function (Model $model) {
            $model->{$model->getKeyName()} = Str::uuid(); // o key name costuma ser o 'id', mas estamos recuperando de forma dinamica
        });
    }
}