<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// ── Portfolio público ────────────────────────────────────────────────────────
Route::get('/', [PortfolioController::class , 'index'])->name('portfolio.index');
Route::get('/projects/{project}', [PortfolioController::class, 'show'])->name('portfolio.projects.show');
Route::post('/contact', [PortfolioController::class , 'contact'])->name('portfolio.contact');

// ── Auth ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class , 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class , 'login'])->name('admin.login');
});
Route::post('/admin/logout', [AuthController::class , 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

// ── Panel Admin ───────────────────────────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class , 'index'])->name('dashboard');

        // Proyectos
        Route::post('projects/reorder', [ProjectController::class , 'reorder'])->name('projects.reorder');
        Route::post('projects/suggest-tags', [ProjectController::class , 'suggestTags'])->name('projects.suggest-tags');
        Route::resource('projects', ProjectController::class)->except(['show']);

        // Skills
        Route::post('skills/reorder', [SkillController::class , 'reorder'])->name('skills.reorder');
        Route::post('skills/suggest-meta', [SkillController::class , 'suggestMeta'])->name('skills.suggest-meta');
        Route::resource('skills', SkillController::class)->except(['show']);

        // Experiencia
        Route::post('experiences/suggest-description', [ExperienceController::class , 'suggestDescription'])->name('experiences.suggest-description');
        Route::resource('experiences', ExperienceController::class)->except(['show']);

        // Mensajes de contacto
        Route::patch('contacts/mark-all-read', [ContactController::class , 'markAllRead'])->name('contacts.mark-all-read');
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

        // Perfil
        Route::get('profile', [ProfileController::class , 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class , 'update'])->name('profile.update');
    });
