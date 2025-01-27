<?php

namespace App\Trait;

use Illuminate\Support\Str;

trait GenerateUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}