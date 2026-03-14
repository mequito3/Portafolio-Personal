<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con estadísticas y mensajes recientes.
     */
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'experiences' => Experience::count(),
            'contacts' => Contact::count(),
            'unread' => Contact::unread()->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts'));
    }
}
