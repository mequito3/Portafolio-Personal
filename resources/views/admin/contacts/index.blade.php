@extends('layouts.admin')

@section('title', 'Mensajes de Contacto')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400">{{ $contacts->total() }} mensaje(s)</p>
    @if($contacts->count() > 0)
    <form method="POST" action="{{ route('admin.contacts.mark-all-read') }}">
        @csrf @method('PATCH')
        <button type="submit"
                class="bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm px-4 py-2 rounded-lg transition-colors">
            <i class="fas fa-check-double mr-1"></i> Marcar todos leídos
        </button>
    </form>
    @endif
</div>

<div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-700 text-gray-400 text-left">
                <th class="px-5 py-3 font-medium w-4"></th>
                <th class="px-5 py-3 font-medium">Remitente</th>
                <th class="px-5 py-3 font-medium">Asunto / Mensaje</th>
                <th class="px-5 py-3 font-medium">Fecha</th>
                <th class="px-5 py-3 font-medium text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse($contacts as $contact)
            <tr class="hover:bg-gray-750 transition-colors {{ !$contact->is_read ? 'bg-indigo-900/10' : '' }}">
                <td class="px-5 py-3">
                    <span class="inline-block w-2 h-2 rounded-full {{ $contact->is_read ? 'bg-gray-600' : 'bg-indigo-400' }}"></span>
                </td>
                <td class="px-5 py-3">
                    <div class="font-medium text-white">{{ $contact->name }}</div>
                    <div class="text-gray-400 text-xs">{{ $contact->email }}</div>
                </td>
                <td class="px-5 py-3">
                    <div class="text-white">{{ $contact->subject ?? '—' }}</div>
                    <div class="text-gray-400 text-xs truncate max-w-xs">{{ Str::limit($contact->message, 70) }}</div>
                </td>
                <td class="px-5 py-3 text-gray-400 whitespace-nowrap">
                    {{ $contact->created_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-5 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.contacts.show', $contact) }}"
                           class="text-indigo-400 hover:text-indigo-300 transition-colors px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                              onsubmit="return confirm('¿Eliminar este mensaje?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors px-2 py-1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-5 py-10 text-center text-gray-500">No hay mensajes aún</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contacts->hasPages())
    <div class="mt-4">{{ $contacts->links() }}</div>
@endif

@endsection
