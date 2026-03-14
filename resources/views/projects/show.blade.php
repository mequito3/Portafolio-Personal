@extends('layouts.app')

@section('title', $project->title . ' - Detalle del Proyecto')

@section('content')
<div class="min-h-screen pt-24 md:pt-32 pb-20 px-4 md:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header del Proyecto -->
        <div class="mb-12 animate-fade-in" style="animation-delay: 0.1s">

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div>
                    <h1 class="text-4xl md:text-6xl font-display font-bold text-white tracking-tight italic mb-4">
                        {{ $project->title }}
                    </h1>
                    <div class="flex flex-wrap gap-3">
                        @foreach($project->tags as $tag)
                            <span class="px-4 py-2 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[11px] font-bold uppercase tracking-wider">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" 
                           class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/20 hover:scale-[1.05] active:scale-95 transition-all uppercase tracking-widest text-xs flex items-center gap-3">
                            <i class="fas fa-external-link-alt"></i>
                            Ver Demo en Vivo
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" 
                           class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-2xl font-bold hover:bg-white/10 transition-all uppercase tracking-widest text-xs flex items-center gap-3">
                            <i class="fab fa-github text-lg"></i>
                            Repositorio
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Layout Grilla -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Columna Izquierda: Imagen y Galería -->
            <div class="lg:col-span-2 space-y-8 animate-fade-in" style="animation-delay: 0.2s">
                <!-- Imagen Principal -->
                <div class="glass-card overflow-hidden rounded-3xl md:rounded-[2.5rem] border-white/5 shadow-2xl group">
                    <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full aspect-video object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                <!-- Galería si existe -->
                @if(is_array($project->images) && count($project->images) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($project->images as $img)
                            <div class="glass-card aspect-video rounded-3xl overflow-hidden border-white/5 cursor-pointer hover:border-indigo-500/30 transition-all group"
                                 onclick="openLightbox('{{ Str::startsWith($img, 'http') ? $img : asset('storage/' . $img) }}')">
                                <img src="{{ Str::startsWith($img, 'http') ? $img : asset('storage/' . $img) }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Contenido Detallado -->
                <div class="glass-card p-6 md:p-12 rounded-3xl md:rounded-[2.5rem] border-white/5 animate-fade-in" style="animation-delay: 0.3s">
                    <h3 class="text-2xl font-display font-bold text-white mb-8 italic flex items-center gap-4">
                        <span class="w-12 h-[2px] bg-indigo-500"></span>
                        Sobre el Proyecto
                    </h3>
                    <div class="prose prose-invert max-w-none text-gray-400 leading-relaxed space-y-6 text-lg">
                        @if($project->content)
                            {!! nl2br(e($project->content)) !!}
                        @else
                            <p>{{ $project->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Sidebar con info rápida -->
            <div class="space-y-8 animate-fade-in" style="animation-delay: 0.4s">
                <div class="glass-card p-8 rounded-3xl md:rounded-[2.5rem] border-white/5 sticky top-32">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-[3px] mb-8">Ficha Técnica</h4>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 flex-shrink-0">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Fecha</p>
                                <p class="text-white font-medium">{{ $project->created_at->translatedFormat('F Y') }}</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 flex-shrink-0">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Categoría</p>
                                <p class="text-white font-medium">Desarrollo Web / Full Stack</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-4" x-data="{ copied: false }">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 flex-shrink-0 cursor-pointer hover:bg-cyan-500/20 transition-colors"
                                 @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)">
                                <i class="fas fa-share-nodes"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Compartir</p>
                                <p class="text-white font-medium cursor-pointer hover:text-cyan-400 transition-colors"
                                   x-text="copied ? '¡Copiado!' : 'Copiar Enlace'"></p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-12 pt-8 border-t border-white/5">
                        <p class="text-[11px] text-gray-400 italic leading-relaxed">
                            "Este proyecto representa un gran desafío técnico que me permitió perfeccionar mis habilidades en {{ $project->tags[0] ?? 'tecnología' }}."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal (Alpine.js) -->
<div x-data="{ open: false, imgUrl: '' }" 
     @lightbox.window="open = true; imgUrl = $event.detail"
     x-show="open" 
     x-transition.opacity
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl"
     style="display: none;">
    <button @click="open = false" class="absolute top-8 right-8 text-white text-3xl hover:text-indigo-400 transition-colors">
        <i class="fas fa-times"></i>
    </button>
    <img :src="imgUrl" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl animate-zoom-in">
</div>

@section('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    @keyframes zoom-in {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    .animate-zoom-in {
        animation: zoom-in 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection

@section('scripts')
<script>
    function openLightbox(url) {
        window.dispatchEvent(new CustomEvent('lightbox', { detail: url }));
    }
</script>
@endsection
