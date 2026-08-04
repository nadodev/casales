<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'registration', 'summary', 'biography', 'specialties', 'education', 'experience', 'approach', 'email', 'image_path', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['specialties' => 'array', 'education' => 'array', 'experience' => 'array', 'is_active' => 'boolean'];
    }

    public function getRouteKeyName(): string { return 'slug'; }
}
