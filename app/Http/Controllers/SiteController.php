<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\SocialLink;
use App\Models\Treatment;
use App\Models\AboutPage;
use App\Models\Testimonial;

class SiteController extends Controller
{
    private function shared(): array { return ['socialLinks' => SocialLink::where('is_active', true)->orderBy('sort_order')->get(), 'menuTreatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get()]; }
    public function home() { return view('site.home', array_merge($this->shared(), ['professionals' => Professional::where('is_active', true)->orderBy('sort_order')->get(), 'treatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get(), 'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function professionals() { return view('site.professionals.index', array_merge($this->shared(), ['professionals' => Professional::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function professional(Professional $professional) { abort_unless($professional->is_active, 404); return view('site.professionals.show', array_merge($this->shared(), compact('professional'))); }
    public function treatments() { return view('site.treatments.index', array_merge($this->shared(), ['treatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function treatment(Treatment $treatment) { abort_unless($treatment->is_active, 404); return view('site.treatments.show', array_merge($this->shared(), compact('treatment'))); }
    public function about() { $about = AboutPage::with('photos')->where('is_active', true)->firstOrFail(); return view('site.about', array_merge($this->shared(), compact('about'))); }
    public function integratedCare() { return view('site.integrated-care', $this->shared()); }
    public function contact() { return view('site.contact', $this->shared()); }
    public function privacy() { return view('site.privacy', $this->shared()); }
    public function terms() { return view('site.terms', $this->shared()); }
    public function page(string $view) { return view("site.$view", $this->shared()); }
    public function sitemap() { return response()->view('site.sitemap', ['professionals' => Professional::where('is_active', true)->get(), 'treatments' => Treatment::where('is_active', true)->get()])->header('Content-Type', 'application/xml'); }
}
