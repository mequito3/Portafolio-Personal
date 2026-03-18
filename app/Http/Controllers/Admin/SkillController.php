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

        $categoriesList = array_keys(Skill::$categories);
        $categoriesString = implode(', ', $categoriesList);
        
        $systemPrompt = "Eres un experto en infraestructura y desarrollo. Tu misión es categorizar habilidades técnicas.
        DEBES elegir exactamente una de estas claves de categoría: [$categoriesString].
        
        REGLAS CRÍTICAS:
        1. Si la habilidad es un hosting, VPS o servidor (ej: Hostinger, AWS, Google Cloud, Azure, DigitalOcean, Cloudflare, Ubuntu, Nginx), la categoría DEBE SER 'server'.
        2. El icono debe ser la clase completa de FontAwesome 6 (ej: 'fas fa-server', 'fab fa-aws', 'fas fa-cloud', 'fab fa-linux').
        3. Para lenguajes de backend (PHP, Python, Go), usa 'backend'. Para librerías visuales, usa 'frontend'.
        
        RESPUESTA: Solo un objeto JSON plano.
        EJEMPLO: {\"category\": \"server\", \"icon\": \"fas fa-server\"}";
        
        $userPrompt = "Habilidad: $name. Sugiere la categoría e icono perfectos.";

        $result = $aiService->getSuggestions($systemPrompt, $userPrompt);

        // Fallback default if AI fails or categorization is unclear
        $fallback = ['category' => 'other', 'icon' => 'fas fa-tag'];
        
        return response()->json($result ?? $fallback);
    }
}
