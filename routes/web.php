<?php

use App\Http\Controllers\Admin\{AboutPageController,AuthController,DashboardController,ProfessionalController,SocialLinkController,TestimonialController,TreatmentController};
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/profissionais', [SiteController::class, 'professionals'])->name('professionals');
Route::get('/profissionais/{professional:slug}', [SiteController::class, 'professional'])->name('professionals.show');
Route::get('/tratamentos', [SiteController::class, 'treatments'])->name('treatments');
Route::get('/tratamentos/{treatment:slug}', [SiteController::class, 'treatment'])->name('treatments.show');
Route::get('/nossa-historia', [SiteController::class, 'about'])->name('about');
Route::get('/cuidado-integrado', [SiteController::class, 'integratedCare'])->name('integrated-care');
Route::get('/contato', [SiteController::class, 'contact'])->name('contact');
Route::get('/privacidade', [SiteController::class, 'privacy'])->name('privacy');
Route::get('/termos', [SiteController::class, 'terms'])->name('terms');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');

Route::middleware('guest')->group(function () { Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login'); Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store'); });
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard'); Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::resource('treatments', TreatmentController::class)->except('show');
    Route::resource('professionals', ProfessionalController::class)->except('show');
    Route::resource('social-links', SocialLinkController::class)->except('show');
    Route::get('about', [AboutPageController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutPageController::class, 'update'])->name('about.update');
    Route::delete('about/{aboutPage}/photos/{photo}', [AboutPageController::class, 'destroyPhoto'])->name('about.photos.destroy');
    Route::resource('testimonials', TestimonialController::class)->except('show');
});
