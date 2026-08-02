<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'registration', 'summary', 'biography', 'specialties', 'email', 'image_path', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['specialties' => 'array', 'is_active' => 'boolean'];
    }

    public function getRouteKeyName(): string { return 'slug'; }
}
