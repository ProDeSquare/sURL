<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionsController extends Controller
{
    public function view ()
    {
        return Inertia::render('Collections/Index', [
            'collections' => cache()->remember(
                Collection::cacheId(),
                config('cache.default_period'),
                fn () =>
                    Auth::user()->collections()->orderBy('name')->get(),
            ),
        ]);
    }

    public function create (Request $request)
    {
        Auth::user()->collections()->updateOrCreate($request->validate([
            'name' => 'required|string',
        ]));

        return to_route('create-collection-page');
    }

    public function delete (Collection $collection)
    {
        Auth::id() === $collection->user_id && $collection->delete();

        return to_route('create-collection-page');
    }
}
