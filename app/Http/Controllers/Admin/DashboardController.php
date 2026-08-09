<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{AboutPage,ContactMessage,Professional,SocialLink,Testimonial,Treatment};
class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'treatments' => Treatment::count(),
            'professionals' => Professional::count(),
            'testimonials' => Testimonial::count(),
            'aboutPages' => AboutPage::count(),
            'contactMessages' => ContactMessage::count(),
            'unreadMessages' => ContactMessage::whereNull('read_at')->count(),
            'latestUnreadMessages' => ContactMessage::whereNull('read_at')->latest()->limit(5)->get(),
            'socialLinks' => SocialLink::count(),
        ]);
    }
}
