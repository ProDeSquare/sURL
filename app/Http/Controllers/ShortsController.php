<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Short;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ShortsController extends Controller
{
    public function redirect (Short $short)
    {
        $short->enabled || abort(404);

        return Redirect::to($short->url);
    }

    public function view ()
    {
        return Inertia::render('Short/CreateShort', [
            'collections' => Auth::user()->collections()->orderBy('name')->get(),
        ]);
    }

    public function edit (Short $short)
    {
        return Inertia::render('Short/UpdateShort', [
            'short' => $short
        ]);
    }

    public function create (Request $request)
    {
        $request->filled('hash') || $request['hash'] = bin2hex(random_bytes(5));

        $request->filled('collection') &&
        $collection = Auth::user()->collections()->findOrFail($request->collection);

        Auth::user()->shorts()->create([
            'collection_id' => $collection->id ?? null,

            ...$request->validate([
                'title' => 'required|max:255',
                'url' => 'required|url',
                'hash' => 'nullable|max:255|alpha_dash|unique:shorts'
            ])
        ]);

        return Inertia::render('Short/CreateShort', [
            'collections' => Auth::user()->collections()->orderBy('name')->get(),
        ]);
    }

    public function update (Request $request, Short $short)
    {
        if (Auth::id() !== $short->user_id) abort(403);

        $short->update($request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'enabled' => 'nullable|boolean'
        ]));

        return Inertia::render('Short/UpdateShort', [
            'short' => Short::where('hash', $short->hash)->first()
        ]);
    }

    public function delete (Short $short)
    {
        Auth::id() === $short->user_id && $short->delete();

        return Inertia::render('Short/UpdateShort');
    }
}
