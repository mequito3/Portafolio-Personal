@extends('layouts.admin')

@section('title', 'Proyectos')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <h1 class="text-3xl font-display font-bold text-white tracking-tight mb-1">
            Gestión de <span class="gradient-text">Proyectos</span>
        </h1>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-widest">{{ $projects->total() }} items en total</p>
    </div>
    
    <a href="{{ route('admin.projects.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/25 hover:scale-105 hover:shadow-indigo-500/40 transition-all group">
        <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
        <span>Nuevo Proyecto</span>
    </a>
</div>

<div class="glass-card rounded-[2rem] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 border-b border-white/5">
                    <th class="px-8 py-5 text-[11px] font-bold text-gray-500 uppercase tracking-[2px] w-12 text-center"></th>
                    <th class="px-8 py-5 text-[11px] font-bold text-gray-500 uppercase tracking-[2px]">Proyecto</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-gray-500 uppercase tracking-[2px]">Tecnologías</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-gray-500 uppercase tracking-[2px] text-center">Status</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-gray-500 uppercase tracking-[2px] text-right">Acciones</th>
                </tr>
            </thead>
            <tbody id="sortable-projects" class="divide-y divide-white/5">
                @forelse($projects as $project)
                <tr data-id="{{ $project->id }}" class="group hover:bg-white/[0.02] transition-colors relative">
                    <td class="px-4 py-6 text-center text-gray-600 hover:text-indigo-400 cursor-move drag-handle transition-colors">
                        <i class="fas fa-grip-vertical"></i>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center overflow-hidden border border-white/10 group-hover:border-indigo-500/30 transition-colors">
                                @if($project->image)
                                    <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" alt="" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity">
                                @else
                                    <i class="fas fa-rocket text-indigo-400/50 text-xl group-hover:text-indigo-400 transition-colors"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $project->title }}</h3>
                                <p class="text-xs text-gray-500 mt-1 max-w-[200px] truncate">{{ $project->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice((array)$project->tags, 0, 3) as $tag)
                                <span class="px-2.5 py-1 rounded-lg bg-indigo-500/10 text-indigo-300 text-[10px] font-bold uppercase tracking-wider border border-indigo-500/20">
                                    {{ $tag }}
                                </span>
                            @endforeach
                            @if(count((array)$project->tags) > 3)
                                <span class="text-[10px] text-gray-600 font-bold ml-1">+{{ count((array)$project->tags) - 3 }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex gap-2">
                                @if($project->is_featured)
                                    <span class="w-6 h-6 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 shadow-lg shadow-yellow-500/20" title="Destacado">
                                        <i class="fas fa-star text-[10px]"></i>
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-widest {{ $project->is_active ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-gray-500/10 text-gray-500 border border-gray-500/20' }}">
                                    {{ $project->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-3 opacity-60 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="w-9 h-9 flex items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-all">
                                <i class="fas fa-pencil-alt text-sm"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este proyecto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="inline-flex w-20 h-20 bg-white/5 rounded-full items-center justify-center text-gray-700 mb-6">
                            <i class="fas fa-rocket text-3xl"></i>
                        </div>
                        <h4 class="text-white font-bold mb-2">No hay proyectos</h4>
                        <p class="text-gray-500 text-sm mb-6 max-w-xs mx-auto">Tu galería está vacía. ¡Es momento de mostrarle al mundo de lo que eres capaz!</p>
                        <a href="{{ route('admin.projects.create') }}" class="text-indigo-400 text-sm font-bold uppercase tracking-widest hover:text-indigo-300">Empezar ahora →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($projects->hasPages())
    <div class="mt-8 px-4">
        {{ $projects->links('vendor.pagination.tailwind-glass') }}
    </div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('sortable-projects');
        if (el) {
            Sortable.create(el, {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'bg-indigo-500/10',
                onEnd: function () {
                    let order = [];
                    document.querySelectorAll('#sortable-projects tr').forEach((row) => {
                        let id = row.getAttribute('data-id');
                        if(id) order.push(id);
                    });

                    fetch('{{ route('admin.projects.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            // Optional: Show a subtle toast notification confirming the save
                            console.log('Orden guardado con éxito');
                        }
                    });
                }
            });
        }
    });
</script>
@endpush
