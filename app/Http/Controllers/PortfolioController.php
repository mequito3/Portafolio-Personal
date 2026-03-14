<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Contact;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Muestra la página principal del portafolio cargando datos desde la BD.
     */
    public function index()
    {
        // Cargar admin user (primer usuario admin)
        $admin = User::where('is_admin', true)->first();

        // Proyectos activos ordenados — eager load evita N+1
        $projects = Project::active()->ordered()->get();

        // Skills agrupadas por categoría
        $skills = Skill::active()->ordered()->get()->groupBy('category');

        // Experiencia ordenada
        $experiences = Experience::ordered()->get();

        // Si no hay datos en BD, usar valores por defecto
        $profile = [
            'name'     => $admin?->name        ?? 'Tu Nombre',
            'title'    => $admin?->job_title   ?? 'Desarrollador Full Stack',
            'email'    => $admin?->email       ?? 'tu@email.com',
            'phone'    => $admin?->phone       ?? '+1 234 567 890',
            'location' => $admin?->location    ?? 'Tu Ciudad, País',
            'bio'      => $admin?->bio         ?? 'Soy un desarrollador apasionado por crear experiencias digitales.',
            'avatar'   => $admin?->avatar,
            'logo'     => $admin?->logo,
            'logo_dark'=> $admin?->logo_dark,
            'favicon'  => $admin?->favicon,
            'social'   => [
                'github'   => $admin?->github_url   ?? '#',
                'linkedin' => $admin?->linkedin_url ?? '#',
                'twitter'  => $admin?->twitter_url  ?? '#',
            ],
            'stack'    => [
                'backend'  => $admin?->stack_backend  ?? 'Laravel',
                'frontend' => $admin?->stack_frontend ?? 'Vue.js / React',
                'database' => $admin?->stack_database ?? 'MySQL / PostgreSQL',
                'devops'   => $admin?->stack_devops   ?? 'Docker / AWS',
            ],
            'stats'    => [
                'years_experience' => $admin?->years_experience ?? 0,
                'clients_count'    => $admin?->clients_count    ?? 0,
                'projects_count'   => $projects->count(),
            ],
        ];

        return view('portfolio', compact('profile', 'projects', 'skills', 'experiences'));
    }

    /**
     * Procesa el formulario de contacto y lo guarda en la BD.
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => '¡Mensaje enviado! Me pondré en contacto contigo pronto.'], 200);
        }

        return back()->with('success', '¡Mensaje enviado! Me pondré en contacto contigo pronto.');
    }
}
