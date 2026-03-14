@extends('layouts.admin')

@section('title', 'Habilidades')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <h1 class="text-3xl font-display font-bold text-white tracking-tight mb-1">
            Mis <span class="gradient-text">Habilidades</span>
        </h1>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-widest">{{ $skills->flatten()->count() }} items en total</p>
    </div>
    
    <a href="{{ route('admin.skills.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/25 hover:scale-105 hover:shadow-indigo-500/40 transition-all group">
        <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
        <span>Nueva Habilidad</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    @forelse($skills as $category => $items)
    <div class="glass-card rounded-[2rem] overflow-hidden flex flex-col h-full animate-slide-in" style="animation-delay: {{ $loop->index * 100 }}ms;">
        {{-- Header --}}
        <div class="px-8 py-6 border-b border-white/5 bg-white/[0.02] flex items-center justify-between relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-transparent"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30">
                    @if($category === 'frontend') <i class="fas fa-desktop"></i>
                    @elseif($category === 'backend') <i class="fas fa-server"></i>
                    @elseif($category === 'database') <i class="fas fa-database"></i>
                    @elseif($category === 'devops') <i class="fas fa-cloud"></i>
                    @elseif($category === 'mobile') <i class="fas fa-mobile-alt"></i>
                    @else <i class="fas fa-layer-group"></i> @endif
                </div>
                <div>
                    <h3 class="font-display font-bold text-lg text-white capitalize">{{ $category }}</h3>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $items->count() }} Skills</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="flex-1 p-6 space-y-3 sortable-skills-list">
            @foreach($items as $skill)
            <div data-id="{{ $skill->id }}" class="group relative flex items-center gap-4 p-4 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10 transition-all bg-dark-800/20">
                {{-- Drag Handle --}}
                <div class="cursor-move drag-handle text-gray-600 hover:text-indigo-400 px-1 transition-colors">
                    <i class="fas fa-grip-vertical"></i>
                </div>
                
                {{-- Icon --}}
                <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center text-xl text-gray-400 group-hover:text-indigo-400 group-hover:border-indigo-500/30 transition-all shadow-inner relative overflow-hidden">
                    <div class="absolute inset-0 bg-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    @if($skill->icon)
                        <i class="{{ $skill->icon }} relative z-10 drop-shadow-lg"></i>
                    @else
                        <i class="fas fa-code relative z-10"></i>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-bold text-white text-sm truncate group-hover:text-indigo-300 transition-colors">{{ $skill->name }}</h4>
                        @if($skill->is_active)
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                        @else
                            <span class="text-[9px] font-bold uppercase tracking-widest text-gray-500 border border-gray-700 px-1.5 py-0.5 rounded-md">Oculto</span>
                        @endif
                    </div>
                    
                    {{-- Progress Bar --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-1.5 bg-gray-800 rounded-full overflow-hidden border border-gray-700/50">
                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 shadow-[0_0_10px_rgba(99,102,241,0.5)] transition-all duration-1000 ease-out relative" 
                                 style="width: 0%" 
                                 x-data x-init="setTimeout(() => { $el.style.width = '{{ $skill->level }}%' }, 300)">
                                 <div class="absolute right-0 top-0 bottom-0 w-4 bg-white/20 blur-[2px]"></div>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-gray-500 font-mono w-7 text-right">{{ $skill->level }}%</span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity absolute right-4 md:relative md:opacity-100">
                    <a href="{{ route('admin.skills.edit', $skill) }}"
                       class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-all">
                        <i class="fas fa-pencil-alt text-xs"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}"
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta habilidad?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="col-span-full">
        <div class="glass-card rounded-[2rem] p-20 text-center border-white/5">
            <div class="inline-flex w-24 h-24 bg-white/5 rounded-full items-center justify-center text-gray-700 mb-6 border border-white/10 shadow-inner">
                <i class="fas fa-magic text-4xl"></i>
            </div>
            <h4 class="text-xl font-display font-bold text-white mb-3">No hay habilidades aún</h4>
            <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto leading-relaxed">Comienza a construir tu arsenal tecnológico. Añade las herramientas y lenguajes que dominas para impresionar a tus clientes.</p>
            <a href="{{ route('admin.skills.create') }}" 
               class="inline-flex items-center gap-2 text-indigo-400 text-sm font-bold uppercase tracking-widest hover:text-indigo-300 transition-colors">
                <span>Agregar tu primera Skill</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.sortable-skills-list').forEach(function (el) {
            Sortable.create(el, {
                group: 'shared', // Permite arrastrar entre categorías si se desea, aunque por ahora solo ordenará visualmente
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'bg-indigo-500/10',
                onEnd: function () {
                    // Recolectar el orden de todos los items en la pantalla para una reordenación global
                    let order = [];
                    document.querySelectorAll('.sortable-skills-list > div[data-id]').forEach((row) => {
                        let id = row.getAttribute('data-id');
                        if (id) order.push(id);
                    });

                    fetch('{{ route('admin.skills.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Orden guardado con éxito');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
