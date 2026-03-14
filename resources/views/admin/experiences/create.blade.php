@extends('layouts.admin')

@section('title', 'Nueva Experiencia')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.experiences.index') }}" class="text-indigo-400 hover:underline text-sm mb-4 inline-block">
        ← Volver a Experiencias
    </a>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <form method="POST" action="{{ route('admin.experiences.store') }}" class="space-y-5">
            @csrf
            @include('admin.experiences._form')
            <div class="pt-2">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Crear Experiencia
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
