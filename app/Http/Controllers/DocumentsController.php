<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentsController extends Controller
{
    // GET /api/documents (200)
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Document::latest()->get(),
        ], 200);
    }

    // GET /api/documents/{id} (200/404)
    public function show($id)
    {
        $doc = Document::find($id);

        if (!$doc) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $doc,
        ], 200);
    }

    // POST /api/documents (201/422)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|min:5',
            'content' => 'required|string|min:20|max:300',
        ]);

        $validated['title'] = $this->addPrefixToDocumentName($validated['title']);

        $doc = Document::create($validated);

        return response()->json([
            'success' => true,
            'data' => $doc,
        ], 201);
    }

    // PUT /api/documents/{id} (200/404/422)
    public function update(Request $request, $id)
    {
        $doc = Document::find($id);

        if (!$doc) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found',
            ], 404);
        }

        $validated = $request->validate([
            'title'   => 'required|string|min:5',
            'content' => 'required|string|min:20|max:300',
        ]);

        $validated['title'] = $this->addPrefixToDocumentName($validated['title']);

        $doc->update($validated);

        return response()->json([
            'success' => true,
            'data' => $doc->fresh(),
        ], 200);
    }

    // DELETE /api/documents/{id} (200/404)
    public function destroy($id)
    {
        $doc = Document::find($id);

        if (!$doc) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found',
            ], 404);
        }

        $doc->delete();

        return response()->json([
            'success' => true,
            'message' => 'Document deleted',
        ], 200);
    }

    private function addPrefixToDocumentName($name)
    {
        return 'document_saya_' . $name;
    }

    // GET /api/countries
    public function countries()
    {
        // Suggest guna API yang stabil
        $response = Http::get('https://restcountries.com/v3.1/all');

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch countries',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $response->json(),
        ], 200);
    }
}
