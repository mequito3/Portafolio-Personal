@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    @php
    $cards = [
        ['label' => 'Proyectos',    'value' => $stats['projects'],    'icon' => 'fa-rocket',       'color' => 'indigo',  'route' => 'admin.projects.index'],
        ['label' => 'Habilidades',  'value' => $stats['skills'],      'icon' => 'fa-microchip',    'color' => 'cyan',    'route' => 'admin.skills.index'],
        ['label' => 'Experiencias', 'value' => $stats['experiences'], 'icon' => 'fa-briefcase',    'color' => 'purple',  'route' => 'admin.experiences.index'],
        ['label' => 'Mensajes',     'value' => $stats['contacts'],    'icon' => 'fa-paper-plane',  'color' => 'emerald', 'route' => 'admin.contacts.index'],
        ['label' => 'Pendientes',   'value' => $stats['unread'],      'icon' => 'fa-bell',         'color' => 'rose',    'route' => 'admin.contacts.index'],
    ];
    @endphp

    @foreach($cards as $card)
    <a href="{{ route($card['route']) }}"
       class="glass-card group p-6 rounded-3xl relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-{{ $card['color'] }}-500/10 rounded-full blur-2xl group-hover:bg-{{ $card['color'] }}-500/20 transition-all"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-{{ $card['color'] }}-500/10 rounded-2xl flex items-center justify-center text-{{ $card['color'] }}-400 group-hover:scale-110 transition-transform">
                    <i class="fas {{ $card['icon'] }} text-xl"></i>
                </div>
                <span class="text-3xl font-display font-bold text-white tracking-tight">{{ $card['value'] }}</span>
            </div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider group-hover:text-white transition-colors">{{ $card['label'] }}</p>
        </div>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Quick Actions --}}
    <div class="glass-card p-8 rounded-3xl lg:col-span-1">
        <h3 class="font-display font-bold text-lg text-white mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-indigo-400"></i>
            Acciones Rápidas
        </h3>
        
        <div class="space-y-3">
            <a href="{{ route('admin.projects.create') }}"
               class="flex items-center justify-between group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all">
                <span class="text-sm font-medium text-gray-300 group-hover:text-white">Nuevo Proyecto</span>
                <i class="fas fa-plus text-xs text-indigo-400"></i>
            </a>
            
            <a href="{{ route('admin.skills.create') }}"
               class="flex items-center justify-between group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all">
                <span class="text-sm font-medium text-gray-300 group-hover:text-white">Nueva Habilidad</span>
                <i class="fas fa-plus text-xs text-cyan-400"></i>
            </a>
            
            <a href="{{ route('admin.experiences.create') }}"
               class="flex items-center justify-between group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all">
                <span class="text-sm font-medium text-gray-300 group-hover:text-white">Nueva Experiencia</span>
                <i class="fas fa-plus text-xs text-purple-400"></i>
            </a>

            <hr class="border-white/5 my-2">

            <a href="{{ route('admin.profile.edit') }}"
               class="flex items-center justify-between group p-4 rounded-2xl bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/20 transition-all">
                <span class="text-sm font-medium text-indigo-300">Editar Perfil</span>
                <i class="fas fa-user-pen text-xs"></i>
            </a>
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="glass-card p-8 rounded-3xl lg:col-span-2">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-display font-bold text-lg text-white flex items-center gap-2">
                <i class="fas fa-paper-plane text-emerald-400"></i>
                Mensajes Recientes
            </h3>
            <a href="{{ route('admin.contacts.index') }}" class="text-xs font-bold text-indigo-400 uppercase tracking-widest hover:text-indigo-300 transition-colors">Ver Todo</a>
        </div>

        <div class="space-y-4">
            @forelse($recentContacts as $contact)
                <a href="{{ route('admin.contacts.show', $contact) }}"
                   class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all md:px-6">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full bg-dark-700 flex items-center justify-center text-indigo-400 font-bold">
                            {{ substr($contact->name, 0, 1) }}
                        </div>
                        @if(!$contact->is_read)
                            <span class="absolute top-0 right-0 w-3 h-3 bg-indigo-500 border-2 border-dark-900 rounded-full"></span>
                        @endif
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-sm font-bold text-white truncate">{{ $contact->name }}</h4>
                            <span class="text-[10px] text-gray-500 font-medium uppercase tracking-tighter">{{ $contact->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-400 truncate">{{ $contact->subject ?? $contact->message }}</p>
                    </div>

                    <i class="fas fa-chevron-right text-[10px] text-gray-700"></i>
                </a>
            @empty
                <div class="py-12 text-center">
                    <div class="inline-flex w-16 h-16 bg-white/5 rounded-full items-center justify-center text-gray-600 mb-4">
                        <i class="fas fa-inbox text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Buzón de entrada vacío</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
