@if($errors->any())
<div class="glass border-rose-500/20 bg-rose-500/5 p-6 rounded-3xl mb-8 animate-slide-in">
    <div class="flex items-center gap-3 text-rose-400 mb-4">
        <i class="fas fa-circle-exclamation text-xl"></i>
        <h4 class="font-bold uppercase tracking-widest text-xs">Errores detectados</h4>
    </div>
    <ul class="space-y-2">
        @foreach($errors->all() as $error)
            <li class="flex items-start gap-2 text-sm text-gray-400">
                <span class="text-rose-500 mt-1.5 w-1 h-1 rounded-full bg-rose-500 flex-shrink-0"></span>
                {{ $error }}
            </li>
        @endforeach
    </ul>
</div>
@endif

@php $project = $project ?? null; @endphp

<div class="space-y-8">
    {{-- Title & Description --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-6">
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Título del Proyecto</label>
                <input type="text" name="title" value="{{ old('title', $project?->title) }}" required
                       class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 focus:bg-white/[0.08] transition-all"
                       placeholder="Ej: E-commerce Platform">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Descripción Breve (Para la tarjeta de la Home)</label>
                <textarea name="description" rows="3" required
                          class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 focus:bg-white/[0.08] transition-all resize-none"
                          placeholder="Cuéntanos un poco sobre este proyecto...">{{ old('description', $project?->description) }}</textarea>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Contenido Detallado (Para la página de detalles)</label>
                <textarea name="content" rows="10" 
                          class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 focus:bg-white/[0.08] transition-all resize-y"
                          placeholder="Explica por qué usaste qué tecnología, los retos del proyecto... Suporta HTML si es necesario.">{{ old('content', $project?->content) }}</textarea>
            </div>
        </div>

        <div class="space-y-6">
            <div x-data="techAutocomplete()" class="relative">
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1 flex items-center gap-2">
                    <i class="fas fa-microchip text-indigo-400"></i>
                    Tecnologías Asistidas por IA
                </label>
                
                {{-- Hidden input holding the actual comma-separated values --}}
                <input type="hidden" name="tags" :value="tags.join(',')">
                
                {{-- Visible input for typing --}}
                <div class="w-full bg-white/5 border border-white/10 rounded-2xl p-2 min-h-[56px] flex flex-wrap gap-2 items-center focus-within:border-indigo-500/50 focus-within:bg-white/[0.08] transition-all relative">
                    
                    {{-- Selected Tags Container --}}
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1.5 rounded-xl text-xs font-medium flex items-center gap-2">
                            <span x-text="tag"></span>
                            <button type="button" @click="removeTag(index)" class="hover:text-white transition-colors focus:outline-none">
                                <i class="fas fa-times text-[10px]"></i>
                            </button>
                        </span>
                    </template>

                    {{-- Type Input --}}
                    <input type="text" x-model="search" @keydown.enter.prevent="addTag()" @keydown.comma.prevent="addTag()" @keydown.backspace="removeLastTag()"
                           class="flex-1 bg-transparent border-none outline-none text-white px-2 py-1 min-w-[150px] text-sm placeholder-gray-600"
                           placeholder="Ej: Laravel (Presiona Enter)">
                           
                    {{-- Autocomplete Dropdown --}}
                    <div x-show="suggestions.length > 0" x-transition.opacity class="absolute left-0 top-[calc(100%+8px)] w-full bg-gray-900 border border-white/10 rounded-2xl shadow-2xl z-50 overflow-hidden backdrop-blur-xl">
                        <ul class="max-h-48 overflow-y-auto py-2 custom-scrollbar">
                            <template x-for="suggestion in suggestions" :key="suggestion">
                                <li>
                                    <button type="button" @click="selectSuggestion(suggestion)" class="w-full text-left px-5 py-2.5 text-sm text-gray-300 hover:bg-indigo-500/20 hover:text-white transition-colors flex items-center gap-3">
                                        <i class="fas fa-bolt text-amber-400 text-xs shadow-glow"></i>
                                        <span x-text="suggestion"></span>
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <p class="mt-2 text-[10px] text-gray-500 font-medium italic ml-1">* Empieza a escribir para ver sugerencias IA.</p>

                {{-- Init Script for Alpine.js --}}
                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('techAutocomplete', () => ({
                            tags: {!! json_encode(old('tags', $project?->tagsString) ? explode(',', old('tags', $project?->tagsString)) : []) !!}.map(t => t.trim()).filter(t => t),
                            search: '',
                            commonTechs: ['Laravel', 'PHP', 'Tailwind CSS', 'Vue.js', 'React', 'Livewire', 'MySQL', 'PostgreSQL', 'Docker', 'AWS', 'JavaScript', 'TypeScript', 'Node.js', 'Alpine.js', 'HTML5', 'CSS3', 'Git', 'Bootstrap', 'Figma', 'Python', 'Django'],
                            
                            get suggestions() {
                                if (this.search.trim() === '') return [];
                                return this.commonTechs.filter(tech => 
                                    tech.toLowerCase().includes(this.search.toLowerCase()) && 
                                    !this.tags.includes(tech)
                                );
                            },

                            addTag() {
                                let val = this.search.trim();
                                if (val && !this.tags.includes(val)) {
                                    this.tags.push(val);
                                }
                                this.search = '';
                            },

                            removeTag(index) {
                                this.tags.splice(index, 1);
                            },

                            removeLastTag() {
                                if (this.search === '' && this.tags.length > 0) {
                                    this.tags.pop();
                                }
                            },

                            selectSuggestion(tech) {
                                if (!this.tags.includes(tech)) {
                                    this.tags.push(tech);
                                }
                                this.search = '';
                            }
                        }))
                    })
                </script>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Orden</label>
                    <input type="number" name="order" value="{{ old('order', $project?->order ?? 0) }}" min="0"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 transition-all">
                </div>
                <div class="flex flex-col justify-end gap-3 pb-2 ml-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project?->is_featured) ? 'checked' : '' }} class="peer hidden">
                            <div class="w-5 h-5 border-2 border-white/20 rounded-md peer-checked:bg-indigo-500 peer-checked:border-indigo-500 transition-all flex items-center justify-center">
                                <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-3 group-hover:text-white transition-colors">Destacado</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project?->is_active ?? true) ? 'checked' : '' }} class="peer hidden">
                            <div class="w-5 h-5 border-2 border-white/20 rounded-md peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center">
                                <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-3 group-hover:text-white transition-colors">Visible</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Media & Links --}}
    <div class="glass-card p-8 rounded-[2rem] border-white/5">
        <h3 class="font-display font-bold text-lg text-white mb-8 flex items-center gap-3">
            <i class="fas fa-link text-indigo-400"></i>
            Media y Enlaces
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Subir Imagen Principal</label>
                <div class="relative group">
                    <input type="file" name="image" accept="image/*"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30 transition-all cursor-pointer">
                </div>
                @if(isset($project) && $project->image)
                    <div class="mt-5 glass p-3 inline-block rounded-2xl border-white/5">
                        <p class="text-[10px] text-gray-500 uppercase tracking-[2px] mb-2 ml-1">Imagen Actual:</p>
                        <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" alt="Preview" class="h-24 w-auto rounded-xl border border-white/10 object-cover shadow-lg">
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Galería de Imágenes (Capturas de pantalla)</label>
                <div class="relative group">
                    <input type="file" name="gallery_images[]" accept="image/*" multiple
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30 transition-all cursor-pointer">
                </div>
                @if(isset($project) && is_array($project->images))
                    <div class="mt-5 glass p-4 rounded-2xl border-white/5 flex flex-wrap gap-3">
                        @foreach($project->images as $img)
                            <div class="relative group/img">
                                <img src="{{ Str::startsWith($img, 'http') ? $img : asset('storage/' . $img) }}" alt="Gallery Item" class="h-16 w-16 rounded-lg border border-white/10 object-cover shadow-lg">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Enlace del Proyecto (Demo)</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-600 group-focus-within:text-cyan-400 transition-colors">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                    <input type="text" name="demo_url" value="{{ old('demo_url', $project?->demo_url) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-cyan-500/50 transition-all"
                           placeholder="https://mi-app.com">
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-[2px] mb-3 ml-1">Repositorio GitHub</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-600 group-focus-within:text-purple-400 transition-colors">
                        <i class="fab fa-github"></i>
                    </div>
                    <input type="text" name="github_url" value="{{ old('github_url', $project?->github_url) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                           placeholder="https://github.com/tu-usuario/tu-repo">
                </div>
            </div>
        </div>
    </div>
</div>
