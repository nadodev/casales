<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = ['image_path', 'caption', 'sort_order'];
    public function aboutPage() { return $this->belongsTo(AboutPage::class); }
}
