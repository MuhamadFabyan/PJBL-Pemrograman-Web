<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class NoteController extends Controller
{
    // Menampilkan catatan
    public function index()
    {
        $notes = Note::latest()->get();

        return view('catatan.index', compact('notes'));
    }

    // Menyimpan catatan
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $validated['content'] = Purifier::clean(
        $validated['content']
    );

    Note::create($validated);

    return redirect()
        ->route('notes.index')
        ->with('success', 'Catatan berhasil disimpan!');
    }
    // Menghapus catatan
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()
            ->route('notes.index')
            ->with('success', 'Catatan berhasil dihapus!');
    }
}