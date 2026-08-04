<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{AboutPage,Professional,SocialLink,Testimonial,Treatment};
class DashboardController extends Controller { public function __invoke() { return view('admin.dashboard', ['treatments' => Treatment::count(), 'professionals' => Professional::count(), 'testimonials' => Testimonial::count(), 'aboutPages' => AboutPage::count(), 'socialLinks' => SocialLink::count()]); } }
