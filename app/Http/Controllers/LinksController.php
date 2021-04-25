<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    public function redirect (Link $hash)
    {
        if (! $hash->enabled) abort(404);

        return Redirect::to($hash->url);
    }

    public function view ()
    {
        return Inertia::render('CreateLink');
    }

    public function edit (Link $link)
    {
        return Inertia::render('UpdateLink', [
            'link' => $link
        ]);
    }

    public function create (Request $request)
    {
        if (! $request->hash) $request['hash'] = bin2hex(random_bytes(5));

        Auth::user()->links()->create($request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'hash' => 'nullable|max:255|unique:links'
        ]));

        return Inertia::render('CreateLink');
    }

    public function update (Request $request, Link $link)
    {
        if (Auth::id() !== $link->user_id) abort(403);

        $link->update($request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'enabled' => 'nullable|boolean'
        ]));

        return Inertia::render('UpdateLink', [
            'link' => Link::where('hash', $link->hash)->first()
        ]);

        // return Link::where('hash', $link->hash)->first();
    }
}
