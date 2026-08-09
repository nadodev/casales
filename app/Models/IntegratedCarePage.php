<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegratedCarePage extends Model
{
    protected $fillable = [
        'hero_kicker', 'title', 'intro', 'how_title', 'steps', 'section_kicker',
        'section_title', 'section_intro', 'benefits', 'cta_title', 'cta_text',
        'cta_label', 'cover_image_path', 'seo_description', 'is_active',
    ];

    protected function casts(): array
    {
        return ['steps' => 'array', 'benefits' => 'array', 'is_active' => 'boolean'];
    }
}
