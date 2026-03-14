@extends('layouts.admin')

@section('title', 'Experiencia Laboral')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400">{{ $experiences->count() }} experiencia(s)</p>
    <a href="{{ route('admin.experiences.create') }}"
       class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
        <i class="fas fa-plus"></i> Nueva Experiencia
    </a>
</div>

<div class="space-y-4">
    @forelse($experiences as $exp)
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5 flex items-start justify-between gap-4">
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h3 class="font-semibold text-white">{{ $exp->position }}</h3>
                @if($exp->is_current)
                    <span class="bg-green-900/50 text-green-300 text-xs px-2 py-0.5 rounded">Actual</span>
                @endif
            </div>
            <p class="text-indigo-400 text-sm">{{ $exp->company }}</p>
            <p class="text-gray-500 text-xs mt-0.5">{{ $exp->period }}</p>
            <p class="text-gray-300 text-sm mt-2 line-clamp-2">{{ $exp->description }}</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.experiences.edit', $exp) }}"
               class="text-indigo-400 hover:text-indigo-300 transition-colors px-2 py-1">
                <i class="fas fa-pencil"></i>
            </a>
            <form method="POST" action="{{ route('admin.experiences.destroy', $exp) }}"
                  onsubmit="return confirm('¿Eliminar esta experiencia?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors px-2 py-1">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-10 text-center text-gray-500">
        No hay experiencias aún.
        <a href="{{ route('admin.experiences.create') }}" class="text-indigo-400 hover:underline ml-1">Agrega la primera</a>
    </div>
    @endforelse
</div>

@endsection
