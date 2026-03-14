<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Muestra la lista de mensajes de contacto.
     */
    public function index(): View
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Muestra un mensaje específico y lo marca como leído.
     */
    public function show(Contact $contact): View
    {
        $contact->markAsRead();
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Elimina un mensaje.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Mensaje eliminado.');
    }

    /**
     * Marca todos los mensajes como leídos.
     */
    public function markAllRead(): RedirectResponse
    {
        Contact::unread()->update(['is_read' => true]);
        return back()->with('success', 'Todos los mensajes marcados como leídos.');
    }
}
