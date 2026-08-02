<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'category', 'excerpt', 'description', 'benefits', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['benefits' => 'array', 'is_active' => 'boolean'];
    }

    public function getRouteKeyName(): string { return 'slug'; }
}
