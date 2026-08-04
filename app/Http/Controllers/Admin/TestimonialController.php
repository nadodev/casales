<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() { return view('admin.testimonials.index', ['items' => Testimonial::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.testimonials.form', ['item' => new Testimonial]); }
    public function store(Request $request) { Testimonial::create($this->data($request)); return redirect()->route('admin.testimonials.index')->with('success', 'Avaliação cadastrada.'); }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.form', ['item' => $testimonial]); }
    public function update(Request $request, Testimonial $testimonial) { $testimonial->update($this->data($request)); return redirect()->route('admin.testimonials.index')->with('success', 'Avaliação atualizada.'); }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return back()->with('success', 'Avaliação removida.'); }
    private function data(Request $request): array
    {
        $data = $request->validate(['name' => 'required|max:120', 'context' => 'nullable|max:150', 'content' => 'required|max:1200', 'rating' => 'required|integer|between:1,5', 'sort_order' => 'nullable|integer|min:0', 'is_active' => 'nullable|boolean']);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
