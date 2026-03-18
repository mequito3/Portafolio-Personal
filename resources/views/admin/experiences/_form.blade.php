@if($errors->any())
<div class="bg-red-900/50 border border-red-600 text-red-300 px-4 py-3 rounded-lg mb-2">
    <p class="font-medium flex items-center gap-2 mb-1"><i class="fas fa-exclamation-triangle"></i> Corrige los errores:</p>
    <ul class="list-disc list-inside text-sm space-y-0.5">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

@php $exp = $exp ?? null; @endphp

{{-- Position + Company --}}
<div class="space-y-6" x-data="experienceAI()">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1.5">Cargo <span class="text-red-400">*</span></label>
            <input type="text" name="position" x-model="position" value="{{ old('position', $exp?->position) }}" required
                   class="w-full bg-gray-700 border @error('position') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Desarrollador Full Stack">
            @error('position') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1.5">Empresa <span class="text-red-400">*</span></label>
            <input type="text" name="company" x-model="company" value="{{ old('company', $exp?->company) }}" required
                   class="w-full bg-gray-700 border @error('company') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Empresa S.A.">
            @error('company') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Description --}}
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5 flex items-center justify-between">
            <div class="flex items-center gap-2">
                Descripción <span class="text-red-400">*</span>
            </div>
            <button type="button" @click="suggestDescription()" 
                    class="text-[10px] bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 px-3 py-1 rounded-full border border-indigo-500/20 transition-all flex items-center gap-2 group"
                    :disabled="loadingAI">
                <i class="fas fa-wand-magic-sparkles" :class="loadingAI ? 'animate-spin' : 'group-hover:scale-110 transition-transform'"></i>
                <span x-text="loadingAI ? 'Escribiendo...' : 'Mejorar con IA'"></span>
            </button>
        </label>
        <textarea name="description" x-model="description" rows="5" required
                  class="w-full bg-gray-700 border @error('description') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-y"
                  placeholder="Describe tus responsabilidades y hitos principales...">{{ old('description', $exp?->description) }}</textarea>
        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        <p class="mt-2 text-[10px] text-gray-500 font-medium italic">* Consejo: La IA puede redactar una descripción profesional basada en tu cargo.</p>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('experienceAI', () => ({
                company: '{{ old('company', $exp?->company ?? '') }}',
                position: '{{ old('position', $exp?->position ?? '') }}',
                description: `{!! old('description', $exp?->description ?? '') !!}`,
                loadingAI: false,

                async suggestDescription() {
                    if (!this.company || !this.position) {
                        alert('Por favor, ingresa la empresa y el cargo para que la IA pueda redactar una descripción.');
                        return;
                    }

                    this.loadingAI = true;
                    try {
                        const response = await fetch('{{ route('admin.experiences.suggest-description') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ company: this.company, position: this.position })
                        });
                        const data = await response.json();
                        if (data.description) {
                            this.description = data.description;
                        }
                    } catch (error) {
                        console.error('AI Error:', error);
                    } finally {
                        this.loadingAI = false;
                    }
                }
            }))
        })
    </script>
</div>

{{-- Dates --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha de inicio <span class="text-red-400">*</span></label>
        <input type="date" name="start_date"
               value="{{ old('start_date', $exp?->start_date?->format('Y-m-d')) }}" required
               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('start_date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div id="end-date-container" class="{{ old('is_current', $exp?->is_current) ? 'opacity-40 pointer-events-none' : '' }}">
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha de fin</label>
        <input type="date" name="end_date"
               value="{{ old('end_date', $exp?->end_date?->format('Y-m-d')) }}"
               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>
</div>

{{-- Is Current --}}
<label class="flex items-center gap-2 cursor-pointer">
    <input type="checkbox" name="is_current" id="is_current" value="1"
           {{ old('is_current', $exp?->is_current) ? 'checked' : '' }}
           onchange="document.getElementById('end-date-container').classList.toggle('opacity-40', this.checked); document.getElementById('end-date-container').classList.toggle('pointer-events-none', this.checked)"
           class="w-4 h-4 text-indigo-600 rounded">
    <span class="text-sm text-gray-300">Trabajo actual (sin fecha de fin)</span>
</label>
