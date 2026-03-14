<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Muestra la lista de experiencias.
     */
    public function index(): View
    {
        $experiences = Experience::ordered()->paginate(15);
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create(): View
    {
        return view('admin.experiences.create');
    }

    /**
     * Almacena una nueva experiencia.
     */
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        Experience::create($request->validated());

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experiencia creada correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Actualiza una experiencia existente.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experiencia actualizada correctamente.');
    }

    /**
     * Elimina una experiencia.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();
        return back()->with('success', 'Experiencia eliminada.');
    }
}
