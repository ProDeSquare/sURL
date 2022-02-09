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
            'collections' => Auth::user()->collections()->orderBy('name')->get(),
        ]);
    }

    public function create (Request $request)
    {
        Auth::user()->collections()->updateOrCreate($request->validate([
            'name' => 'required|string',
        ]));

        return Inertia::render('Collections/Index', [
            'collections' => Auth::user()->collections()->orderBy('name')->get(),
        ]);
    }

    public function delete (Collection $collection)
    {
        Auth::id() === $collection->user_id && $collection->delete();

        return Inertia::render('Collections/Index', [
            'collections' => Auth::user()->collections()->orderBy('name')->get(),
        ]);
    }
}
