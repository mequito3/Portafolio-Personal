<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use App\Services\ZhipuAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    /**
     * Sugiere una descripción profesional.
     */
    public function suggestDescription(Request $request, ZhipuAIService $aiService): JsonResponse
    {
        $company = $request->input('company');
        $position = $request->input('position');

        if (!$company || !$position) {
            return response()->json(['error' => 'Company and position are required'], 400);
        }

        $systemPrompt = "Eres un redactor profesional de CVs y perfiles de LinkedIn. Tu tarea es generar una descripción breve y profesional (en español, máximo 4 puntos clave) de las responsabilidades y logros para un puesto de trabajo dado la empresa y el cargo. Responde SOLO en formato JSON con la clave 'description'. Ej: {'description': '- Desarrollo de APIs robustas...\\n- Optimización de base de datos...'}";
        $userPrompt = "Empresa: $company\nCargo: $position";

        $result = $aiService->getSuggestions($systemPrompt, $userPrompt);

        return response()->json($result ?? ['description' => '']);
    }
}
