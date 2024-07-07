<?php

namespace App\Http\Controllers;

use App\Models\Save;
use Inertia\Inertia;
use App\Models\Collection;
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

            'collections' => $this->getCachedCollections(),
        ]);
    }

    public function view ()
    {
        return Inertia::render('Saved/CreateSave', [
            'collections' => $this->getCachedCollections(),
        ]);
    }

    public function save (Request $request)
    {
        $request->filled('collection') && 
            $collection = $this->getCollection($request->collection);

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
            ? $this->getCollection($collection)
            : Auth::user();
    }

    protected function getCollection ($collection)
    {
        return Auth::user()->collections()->findOrFail($collection);
    }

    protected function getCachedCollections ()
    {
        return cache()->remember(
            Collection::cacheId(),
            config('cache.default_period'),
            fn () =>
                Auth::user()->collections()->orderBy('name')->get(),
        );
    }
}
