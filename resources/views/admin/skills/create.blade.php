@extends('layouts.admin')

@section('title', 'Nueva Habilidad')

@section('content')

<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('admin.skills.index') }}" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/20 hover:-translate-x-1 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-display font-bold text-white tracking-tight mb-1">Nueva <span class="gradient-text">Habilidad</span></h1>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-widest">Añade tecnología a tu stack</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.skills.store') }}" class="space-y-10 pb-20">
        @csrf
        
        @include('admin.skills._form')

        <div class="fixed bottom-0 left-0 right-0 z-40 bg-dark-900/80 backdrop-blur-xl border-t border-white/5 p-4 lg:left-64">
            <div class="max-w-5xl mx-auto flex items-center justify-end gap-4">
                <a href="{{ route('admin.skills.index') }}" 
                   class="px-6 py-3 rounded-2xl font-bold text-gray-400 hover:text-white transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/25 hover:scale-105 hover:shadow-indigo-500/40 transition-all group flex items-center gap-3">
                    <span>Guardar Habilidad</span>
                    <i class="fas fa-check group-hover:scale-110 transition-transform"></i>
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
