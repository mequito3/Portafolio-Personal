@extends('layouts.admin')

@section('title', 'Editar Experiencia')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.experiences.index') }}" class="text-indigo-400 hover:underline text-sm mb-4 inline-block">
        ← Volver a Experiencias
    </a>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="space-y-5">
            @csrf @method('PUT')
            @php $exp = $experience; @endphp
            @include('admin.experiences._form')
            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Guardar Cambios
                </button>
                <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}"
                      onsubmit="return confirm('¿Eliminar esta experiencia?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm transition-colors">
                        Eliminar
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>

@endsection
