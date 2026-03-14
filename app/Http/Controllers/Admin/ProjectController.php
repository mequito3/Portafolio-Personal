<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Muestra la lista de proyectos.
     */
    public function index(): View
    {
        $projects = Project::ordered()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Reordena los proyectos mediante AJAX drag & drop.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:projects,id',
        ]);

        foreach ($request->order as $index => $id) {
            Project::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Almacena un nuevo proyecto.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['tags'] = $this->parseTags($data['tags'] ?? null);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyecto creado correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Actualiza un proyecto existente.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        $data['tags'] = $this->parseTags($data['tags'] ?? null);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe y no es una URL externa
            if ($project->image && !Str::startsWith($project->image, 'http')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Elimina un proyecto.
     */
    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image && !Str::startsWith($project->image, 'http')) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return back()->with('success', 'Proyecto eliminado.');
    }

    /**
     * Procesa la cadena de tags a un array.
     */
    private function parseTags(?string $tags): array
    {
        if (!$tags) {
            return [];
        }
        return array_map('trim', explode(',', $tags));
    }
}
