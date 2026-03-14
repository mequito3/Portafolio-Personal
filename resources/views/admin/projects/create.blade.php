@extends('layouts.admin')

@section('title', 'Nuevo Proyecto')

@section('content')

<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('admin.projects.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 transition-all">
            <i class="fas fa-chevron-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-3xl font-display font-bold text-white tracking-tight italic">
                Añadir <span class="gradient-text">Nuevo Proyecto</span>
            </h1>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[2px] mt-1 ml-0.5">Completar todos los campos requeridos</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-10 pb-20">
        @csrf
        
        @include('admin.projects._form')

        <div class="flex items-center justify-end gap-4 pt-6">
            <a href="{{ route('admin.projects.index') }}" class="px-8 py-4 text-sm font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">
                Cancelar
            </a>
            <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/20 hover:scale-[1.02] active:scale-95 transition-all uppercase tracking-widest text-sm">
                Guardar Proyecto
            </button>
        </div>
    </form>
</div>

@endsection
