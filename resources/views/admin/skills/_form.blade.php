@if($errors->any())
<div class="bg-red-900/50 border border-red-600 text-red-300 px-4 py-3 rounded-lg mb-2">
    <p class="font-medium flex items-center gap-2 mb-1"><i class="fas fa-exclamation-triangle"></i> Corrige los errores:</p>
    <ul class="list-disc list-inside text-sm space-y-0.5">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

@php $skill = $skill ?? null; @endphp

<div class="space-y-8" x-data="skillAutocomplete()">
    {{-- Name & AI Search --}}
    <div class="relative">
        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1 flex items-center gap-2">
            <i class="fas fa-magic text-indigo-400"></i> Nombre de la Habilidad
        </label>
        
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-600">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" name="name" x-model="search" @input="updateSuggestions" @keydown.enter.prevent="selectFirstSuggestion"
                   class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 focus:bg-white/[0.08] transition-all"
                   placeholder="Empieza a escribir (ej: Laravel, Docker...) y autocompletaremos el icono y categoría." required>
        </div>
        
        {{-- AI Suggestions Dropdown --}}
        <div x-show="suggestions.length > 0" x-transition class="absolute left-0 top-[calc(100%+8px)] w-full bg-gray-900 border border-white/10 rounded-2xl shadow-2xl z-50 overflow-hidden backdrop-blur-xl">
            <ul class="max-h-60 overflow-y-auto custom-scrollbar">
                <template x-for="suggestion in suggestions" :key="suggestion.name">
                    <li>
                        <button type="button" @click="selectSuggestion(suggestion)" class="w-full text-left px-5 py-3 text-sm text-gray-300 hover:bg-indigo-500/20 hover:text-white transition-colors flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <i :class="suggestion.icon + ' text-lg text-indigo-400 group-hover:text-indigo-300 w-6 text-center'"></i>
                                <span x-text="suggestion.name" class="font-bold"></span>
                            </div>
                            <span class="text-[10px] uppercase tracking-widest text-gray-500 group-hover:text-indigo-300" x-text="suggestion.category"></span>
                        </button>
                    </li>
                </template>
            </ul>
        </div>
        @error('name') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
    </div>

    {{-- Category & Level Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Category --}}
        <div>
            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1 flex items-center gap-2">
                <i class="fas fa-layer-group text-indigo-400"></i> Categoría
            </label>
            <select name="category" x-model="selectedCategory" required
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 appearance-none cursor-pointer">
                @foreach(\App\Models\Skill::$categories as $key => $label)
                    <option value="{{ $key }}" class="bg-gray-800 text-white">{{ $label }}</option>
                @endforeach
            </select>
            @error('category') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
        </div>

        {{-- Level --}}
        <div>
            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-chart-bar text-indigo-400"></i> Nivel de Dominio
                </div>
                <span id="level-value" class="text-indigo-400 font-mono text-sm bg-indigo-500/10 px-2 py-0.5 rounded-md">{{ old('level', $skill?->level ?? 80) }}%</span>
            </label>
            <div class="pt-2">
                <input type="range" name="level" min="0" max="100" step="5"
                       value="{{ old('level', $skill?->level ?? 80) }}"
                       oninput="document.getElementById('level-value').textContent = this.value + '%'"
                       class="w-full h-2 bg-white/10 rounded-lg appearance-none cursor-pointer accent-indigo-500">
            </div>
            @error('level') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
        </div>
    </div>



    {{-- Hidden Icon Input --}}
    <input type="hidden" name="icon" x-model="selectedIcon">

    {{-- Order + Active Data --}}
    <div class="flex items-center gap-8 bg-black/20 p-5 rounded-2xl border border-white/5">
        <div class="w-1/3">
            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Orden de Visualización</label>
            <input type="number" name="order" value="{{ old('order', $skill?->order ?? 0) }}" min="0"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500/50 transition-all font-mono text-sm">
        </div>
        <div class="w-2/3 flex justify-end">
            <label class="flex items-center gap-3 cursor-pointer group mt-4">
                <div class="relative flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $skill?->is_active ?? true) ? 'checked' : '' }} class="peer hidden">
                    <div class="w-6 h-6 border-2 border-white/20 rounded-lg peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center">
                        <i class="fas fa-check text-xs text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-3 group-hover:text-white transition-colors">Skill Visible en el Portafolio</span>
                </div>
            </label>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('skillAutocomplete', () => ({
            search: '{{ old('name', $skill?->name ?? '') }}',
            selectedCategory: '{{ old('category', $skill?->category ?? 'frontend') }}',
            selectedIcon: '{{ old('icon', $skill?->icon ?? 'fas fa-code') }}',
            
            // Base de datos de IA para autocompletar
            knowledgeBase: [
                { name: 'Laravel', category: 'backend', icon: 'fab fa-laravel' },
                { name: 'PHP', category: 'backend', icon: 'fab fa-php' },
                { name: 'React', category: 'frontend', icon: 'fab fa-react' },
                { name: 'Vue.js', category: 'frontend', icon: 'fab fa-vuejs' },
                { name: 'Tailwind CSS', category: 'frontend', icon: 'fab fa-css3-alt' },
                { name: 'JavaScript', category: 'frontend', icon: 'fab fa-js' },
                { name: 'Node.js', category: 'backend', icon: 'fab fa-node-js' },
                { name: 'MySQL', category: 'database', icon: 'fas fa-database' },
                { name: 'PostgreSQL', category: 'database', icon: 'fas fa-database' },
                { name: 'Docker', category: 'devops', icon: 'fab fa-docker' },
                { name: 'AWS', category: 'devops', icon: 'fab fa-aws' },
                { name: 'Git', category: 'tools', icon: 'fab fa-git-alt' },
                { name: 'GitHub', category: 'tools', icon: 'fab fa-github' },
                { name: 'Figma', category: 'tools', icon: 'fab fa-figma' },
                { name: 'Python', category: 'backend', icon: 'fab fa-python' },
                { name: 'Java', category: 'backend', icon: 'fab fa-java' },
                { name: 'Android', category: 'mobile', icon: 'fab fa-android' },
                { name: 'iOS / Swift', category: 'mobile', icon: 'fab fa-apple' },
                { name: 'Flutter', category: 'mobile', icon: 'fas fa-mobile-alt' },
            ],
            
            get suggestions() {
                if (this.search === '{{ old('name', $skill?->name ?? '') }}' || this.search.trim() === '') return [];
                const term = this.search.toLowerCase();
                return this.knowledgeBase.filter(s => s.name.toLowerCase().includes(term));
            },
            
            selectSuggestion(suggestion) {
                this.search = suggestion.name;
                this.selectedCategory = suggestion.category;
                this.selectedIcon = suggestion.icon;
                
                // Retrasar levemente la comprobación para que el DOM se haya actualizado si es necesario
                setTimeout(() => {
                    const selectEl = document.querySelector('select[name="category"]');
                    if (selectEl) {
                        const validOptions = Array.from(selectEl.options).map(o => o.value);
                        if (!validOptions.includes(suggestion.category)) {
                            this.selectedCategory = 'other'; // Usamos 'other' por defecto si no se encuentra
                        }
                    }
                }, 10);
            },
            
            selectFirstSuggestion() {
                if(this.suggestions.length > 0) {
                    this.selectSuggestion(this.suggestions[0]);
                }
            }
        }))
    })
</script>
