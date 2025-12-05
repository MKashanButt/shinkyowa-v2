<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('stock')
            ->paginate(8);

        return view('admin.document.index', compact('documents'));
    }

    public function create()
    {
        $stocks = Stock::pluck('id', 'sid');

        return view('admin.document.create', compact('stocks'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $validated = $request->validated();

        $fileFields = [
            'japanese_export',
            'english_export',
            'final_invoice',
            'inspection_certificate',
            'bl_copy'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('documents', 'public');
            } else {
                $validated[$field] = null;
            }
        }

        Document::create($validated);

        return redirect()->route('admin.document.index')
            ->with('success', 'Documents uploaded successfully.');
    }

    public function edit(Document $document)
    {
        $stocks = Stock::pluck('id', 'sid');

        return view('admin.document.edit', compact('document', 'stocks'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $validated = $request->validated();

        foreach (['japanese_export', 'english_export', 'final_invoice', 'inspection_certificate', 'bl_copy'] as $field) {
            if ($request->hasFile($field)) {
                Storage::disk('public')->delete($document->$field);
                $validated[$field] = $request->file($field)->store('documents', 'public');
            } else {
                unset($validated[$field]);
            }
        }

        $document->update($validated);

        return redirect()->route('admin.document.index')
            ->with('success', 'Documents updated successfully.');
    }

    public function destroy(Document $document)
    {
        if (Auth::check() && !Auth::user()->hasPermission('can_delete_document')) {
            return abort(403, 'Unauthorized action.');
        }

        $files = [
            $document->japanese_export,
            $document->english_export,
            $document->final_invoice,
            $document->inspection_certificate,
            $document->bl_copy
        ];

        $document->delete();

        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        return redirect()->route('admin.document.index')
            ->with('success', 'Document and all associated files deleted successfully.');
    }
}
