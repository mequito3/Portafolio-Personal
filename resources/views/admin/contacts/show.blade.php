@extends('layouts.admin')

@section('title', 'Mensaje de ' . $contact->name)

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.contacts.index') }}" class="text-indigo-400 hover:underline text-sm mb-4 inline-block">
        ← Volver a Mensajes
    </a>

    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 space-y-4">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-white">{{ $contact->name }}</h2>
                <a href="mailto:{{ $contact->email }}" class="text-indigo-400 hover:underline text-sm">
                    {{ $contact->email }}
                </a>
                @if($contact->phone)
                    <span class="text-gray-500 ml-3 text-sm">{{ $contact->phone }}</span>
                @endif
            </div>
            <span class="text-xs text-gray-500 whitespace-nowrap">
                {{ $contact->created_at->format('d/m/Y H:i') }}
            </span>
        </div>

        @if($contact->subject)
        <div>
            <span class="text-xs text-gray-500 uppercase tracking-wider">Asunto</span>
            <p class="text-white font-medium mt-0.5">{{ $contact->subject }}</p>
        </div>
        @endif

        <div>
            <span class="text-xs text-gray-500 uppercase tracking-wider">Mensaje</span>
            <div class="mt-2 bg-gray-700/50 rounded-lg p-4 text-gray-200 whitespace-pre-wrap text-sm leading-relaxed">
                {{ $contact->message }}
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Tu mensaje') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                <i class="fas fa-reply"></i> Responder por email
            </a>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                  onsubmit="return confirm('¿Eliminar este mensaje?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="bg-red-900/50 hover:bg-red-900 text-red-300 text-sm px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
