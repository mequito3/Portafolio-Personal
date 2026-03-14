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
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Cargo <span class="text-red-400">*</span></label>
        <input type="text" name="position" value="{{ old('position', $exp?->position) }}" required
               class="w-full bg-gray-700 border @error('position') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Desarrollador Full Stack">
        @error('position') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Empresa <span class="text-red-400">*</span></label>
        <input type="text" name="company" value="{{ old('company', $exp?->company) }}" required
               class="w-full bg-gray-700 border @error('company') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Empresa S.A.">
        @error('company') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Description --}}
<div>
    <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción <span class="text-red-400">*</span></label>
    <textarea name="description" rows="3" required
              class="w-full bg-gray-700 border @error('description') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-y"
              placeholder="Describe tus responsabilidades...">{{ old('description', $exp?->description) }}</textarea>
    @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
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
