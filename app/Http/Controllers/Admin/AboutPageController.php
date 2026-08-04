<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function edit()
    {
        return view('admin.about.edit', ['item' => AboutPage::firstOrNew()]);
    }

    public function update(Request $request)
    {
        $item = AboutPage::firstOrNew();
        $data = $request->validate([
            'title' => 'required|max:150', 'subtitle' => 'nullable|max:240', 'story' => 'required',
            'highlight_title' => 'nullable|max:150', 'highlight_text' => 'nullable|max:1000',
            'cover_image' => 'nullable|image|max:6144', 'gallery.*' => 'nullable|image|max:6144',
            'captions.*' => 'nullable|max:180', 'is_active' => 'nullable|boolean',
        ]);
        unset($data['cover_image'], $data['gallery'], $data['captions']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('cover_image')) {
            if ($item->cover_image_path) Storage::disk('public')->delete($item->cover_image_path);
            $data['cover_image_path'] = $request->file('cover_image')->store('about', 'public');
        }
        $item->fill($data)->save();
        foreach ($request->file('gallery', []) as $index => $photo) {
            $item->photos()->create([
                'image_path' => $photo->store('about/gallery', 'public'),
                'caption' => $request->input("captions.$index"),
                'sort_order' => ($item->photos()->max('sort_order') ?? -1) + 1,
            ]);
        }
        return back()->with('success', 'Página Nossa História atualizada.');
    }

    public function destroyPhoto(AboutPage $aboutPage, int $photo)
    {
        $image = $aboutPage->photos()->findOrFail($photo);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Foto removida da galeria.');
    }
}
