<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Professional,SocialLink,Treatment};
class DashboardController extends Controller { public function __invoke() { return view('admin.dashboard', ['treatments' => Treatment::count(), 'professionals' => Professional::count(), 'socialLinks' => SocialLink::count()]); } }
