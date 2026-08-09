<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegratedCarePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegratedCarePageController extends Controller
{
    public function edit()
    {
        return view('admin.integrated-care.edit', ['item' => IntegratedCarePage::firstOrNew()]);
    }

    public function update(Request $request)
    {
        $item = IntegratedCarePage::firstOrNew();
        $data = $request->validate([
            'hero_kicker' => 'required|max:80', 'title' => 'required|max:180', 'intro' => 'required|max:1200',
            'how_title' => 'required|max:150', 'steps_text' => 'required', 'section_kicker' => 'nullable|max:80',
            'section_title' => 'required|max:180', 'section_intro' => 'nullable|max:1200', 'benefits_text' => 'required',
            'cta_title' => 'required|max:180', 'cta_text' => 'nullable|max:600', 'cta_label' => 'required|max:80',
            'seo_description' => 'nullable|max:320', 'cover_image' => 'nullable|image|max:6144', 'is_active' => 'nullable|boolean',
        ]);

        $data['steps'] = $this->structuredLines($data['steps_text']);
        $data['benefits'] = $this->structuredLines($data['benefits_text']);
        unset($data['steps_text'], $data['benefits_text'], $data['cover_image']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            if ($item->cover_image_path) Storage::disk('public')->delete($item->cover_image_path);
            $data['cover_image_path'] = $request->file('cover_image')->store('integrated-care', 'public');
        }

        $item->fill($data)->save();
        return back()->with('success', 'Página Cuidado Integrado atualizada.');
    }

    private function structuredLines(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(function ($line) {
                [$title, $description] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');
                return ['title' => $title, 'text' => $description];
            })
            ->filter(fn ($item) => $item['title'] !== '')
            ->values()->all();
    }
}
