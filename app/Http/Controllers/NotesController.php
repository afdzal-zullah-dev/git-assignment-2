<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // GET /api/notes (200)
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Note::latest()->get()
        ], 200);
    }

    // GET /api/notes/{id} (200 / 404)
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'success' => false,
                'message' => 'Note not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $note
        ], 200);
    }

    // POST /api/notes (201 / 422)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|min:3',
            'content' => 'required|min:5|max:300',
        ]);

        $note = Note::create($validated);

        return response()->json([
            'success' => true,
            'data' => $note
        ], 201);
    }

    // PUT /api/notes/{id} (200 / 404 / 422)
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'success' => false,
                'message' => 'Note not found'
            ], 404);
        }

        $validated = $request->validate([
            'title'   => 'required|min:3',
            'content' => 'required|min:5|max:300',
        ]);

        $note->update($validated);

        return response()->json([
            'success' => true,
            'data' => $note
        ], 200);
    }

    // DELETE /api/notes/{id} (200 / 404)
    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'success' => false,
                'message' => 'Note not found'
            ], 404);
        }

        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note deleted'
        ], 200);
    }
}
