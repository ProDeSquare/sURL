<?php

namespace App\Http\Controllers;

use App\Models\Save;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedLinksController extends Controller
{
    private $base,
            $sort = 'title';

    public function index ($collection = null)
    {
        $this->setBase($collection);

        $saves = $this->base->saves()->orderBy($this->sort)->paginate(12);

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

    protected function setBase ($collection)
    {
        $this->base = $collection
            ? Auth::user()->collections()->findOrFail($collection)
            : Auth::user();
    }
}
