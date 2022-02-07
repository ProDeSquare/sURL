<?php

namespace App\Http\Controllers;

use App\Models\Save;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedLinksController extends Controller
{
    public function index ()
    {
        return Inertia::render('Saved/Index', [
            'saves' => Auth::user()->saves()->orderBy('created_at', 'desc')->paginate(12),
        ]);
    }

    public function view ()
    {
        return Inertia::render('Saved/CreateSave', [
            'collections' => Auth::user()->collections()->latest()->get()
        ]);
    }

    public function save (Request $request)
    {
        $request->filled('collection') && 
        $collection = Auth::user()->collections()->findOrFail($request->collection);

        Auth::user()->saves()->create([
            'collection_id' => $collection->id ?? null,

            ...$request->validate([
                'title' => 'required|string',
                'url' => 'required|url',
            ])
        ]);

        return Inertia::render('Saved/CreateSave', [
            'collections' => Auth::user()->collections()->latest()->get()
        ]);
    }

    public function delete (Save $save)
    {
        Auth::id() === $save->user_id && $save->delete();

        return Inertia::render('Saved/Index', [
            'saves' => Auth::user()->saves()->orderBy('created_at', 'desc')->paginate(12),
        ]);
    }
}
