<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfessionalController extends Controller
{
    public function index() { return view('admin.professionals.index', ['items' => Professional::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.professionals.form', ['item' => new Professional]); }
    public function store(Request $request) { Professional::create($this->data($request)); return redirect()->route('admin.professionals.index')->with('success', 'Profissional cadastrado.'); }
    public function edit(Professional $professional) { return view('admin.professionals.form', ['item' => $professional]); }
    public function update(Request $request, Professional $professional) { $professional->update($this->data($request, $professional)); return redirect()->route('admin.professionals.index')->with('success', 'Profissional atualizado.'); }
    public function destroy(Professional $professional) { if ($professional->image_path && ! str_starts_with($professional->image_path, 'images/')) Storage::disk('public')->delete($professional->image_path); $professional->delete(); return back()->with('success', 'Profissional removido.'); }

    private function data(Request $request, ?Professional $item = null): array
    {
        $data = $request->validate([
            'name' => 'required|max:120', 'slug' => ['required', 'max:140', 'alpha_dash', Rule::unique('professionals')->ignore($item)],
            'title' => 'required|max:150', 'registration' => 'nullable|max:80', 'summary' => 'required|max:600',
            'biography' => 'nullable', 'specialties_text' => 'nullable', 'education_text' => 'nullable',
            'experience_text' => 'nullable', 'approach' => 'nullable', 'email' => 'nullable|email|max:150',
            'image' => 'nullable|image|max:4096', 'sort_order' => 'nullable|integer|min:0', 'is_active' => 'nullable|boolean',
        ]);
        foreach (['specialties', 'education', 'experience'] as $field) {
            $data[$field] = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $data[$field.'_text'] ?? ''))));
            unset($data[$field.'_text']);
        }
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            if ($item?->image_path && ! str_starts_with($item->image_path, 'images/')) Storage::disk('public')->delete($item->image_path);
            $data['image_path'] = $request->file('image')->store('professionals', 'public');
        }
        unset($data['image']);
        return $data;
    }
}
