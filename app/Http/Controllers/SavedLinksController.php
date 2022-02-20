<?php

namespace App\Http\Controllers;

use App\Models\Save;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SavedLinksController extends Controller
{
    public function index ($collection = null)
    {
        $saves = $collection
            ? Auth::user()->collections()->findOrFail($collection)->saves()->orderBy('title')->paginate(12)
            : Auth::user()->saves()->orderBy('title')->paginate(12);

        return Inertia::render('Saved/Index', [
            'saves' => $saves,

            'collections' => Auth::user()
                            ->collections()
                            ->orderBy('name')
                            ->get(),
        ]);
    }

    public function view ()
    {
        return Inertia::render('Saved/CreateSave', [
            'collections' => Auth::user()->collections()->orderBy('name')->get()
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

        return to_route('create-save');
    }

    public function delete (Save $save)
    {
        Auth::id() === $save->user_id && $save->delete();

        return to_route('saved-links-index');
    }
}
