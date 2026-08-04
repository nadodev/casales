<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = ['title', 'subtitle', 'story', 'highlight_title', 'highlight_text', 'cover_image_path', 'is_active'];
    protected function casts(): array { return ['is_active' => 'boolean']; }
    public function photos() { return $this->hasMany(GalleryPhoto::class)->orderBy('sort_order'); }
}
