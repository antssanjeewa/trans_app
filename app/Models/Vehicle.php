<?php

namespace App\Models;

use App\Models\File;
use App\Trait\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GenerateUuid;

    protected $fillable = [
        'type',
        'reg_number',
        'fuel_capacity',
    ];

    public function getProfileImageUrlAttribute()
    {
        $file = $this->files()->where('category', 'image')->latest()->first();
        return $file ? asset('storage/' . $file->path) : null;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }


    public function files()
    {
        return $this->morphMany(File::class, 'attachable');
    }

}
