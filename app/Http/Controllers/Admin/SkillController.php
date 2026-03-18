<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Services\ZhipuAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Muestra la lista de habilidades agrupadas por categoría.
     */
    public function index(): View
    {
        $skills = Skill::ordered()->get()->groupBy('category');
        $categories = Skill::$categories;
        return view('admin.skills.index', compact('skills', 'categories'));
    }

    /**
     * Reordena las habilidades mediante AJAX drag & drop.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:skills,id',
        ]);

        foreach ($request->order as $index => $id) {
            Skill::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create(): View
    {
        $categories = Skill::$categories;
        return view('admin.skills.create', compact('categories'));
    }

    /**
     * Almacena una nueva habilidad.
     */
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        Skill::create($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Habilidad creada correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(Skill $skill): View
    {
        $categories = Skill::$categories;
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    /**
     * Actualiza una habilidad existente.
     */
    public function update(UpdateSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Habilidad actualizada correctamente.');
    }

    /**
     * Elimina una habilidad.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();
        return back()->with('success', 'Habilidad eliminada.');
    }

    /**
     * Sugiere categoría e icono basándose en el nombre de la habilidad.
     */
    public function suggestMeta(Request $request, ZhipuAIService $aiService): JsonResponse
    {
        $name = $request->input('name');

        if (!$name) {
            return response()->json(['error' => 'Name is required'], 400);
        }

        $categories = implode(', ', array_keys(Skill::$categories));
        $systemPrompt = "Eres un experto en diseño UI y desarrollo. Tu tarea es sugerir la categoría más adecuada y un icono de FontAwesome 6 (clase CSS, ej: 'fab fa-laravel') para una habilidad técnica dada.
        Categorías permitidas: [$categories].
        Responde SOLO en formato JSON con las claves 'category' e 'icon'. Ej: {'category': 'frontend', 'icon': 'fab fa-react'}";
        
        $userPrompt = "Habilidad: $name";

        $result = $aiService->getSuggestions($systemPrompt, $userPrompt);

        return response()->json($result ?? ['category' => 'other', 'icon' => 'fas fa-code']);
    }
}
