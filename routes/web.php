<?php

use App\Http\Controllers\Admin\{AuthController,DashboardController,ProfessionalController,SocialLinkController,TreatmentController};
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/profissionais.html', [SiteController::class, 'professionals'])->name('professionals');
Route::get('/profissionais/{professional:slug}', [SiteController::class, 'professional'])->name('professionals.show');
Route::get('/tratamentos.html', [SiteController::class, 'treatments'])->name('treatments');
Route::get('/tratamentos/{treatment:slug}', [SiteController::class, 'treatment'])->name('treatments.show');
Route::get('/contato.html', fn() => app(SiteController::class)->page('contact'))->name('contact');
Route::get('/privacidade.html', fn() => app(SiteController::class)->page('privacy'))->name('privacy');
Route::get('/termos.html', fn() => app(SiteController::class)->page('terms'))->name('terms');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::redirect('/tratamento-odontologico.html', '/tratamentos/odontologia', 301);
Route::redirect('/tratamento-fisioterapeutico.html', '/tratamentos/fisioterapia', 301);
Route::redirect('/tratamento-acupuntura.html', '/tratamentos/acupuntura', 301);

Route::middleware('guest')->group(function () { Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login'); Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store'); });
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard'); Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::resource('treatments', TreatmentController::class)->except('show');
    Route::resource('professionals', ProfessionalController::class)->except('show');
    Route::resource('social-links', SocialLinkController::class)->except('show');
});
