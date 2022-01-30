<?php

namespace App\Http\Controllers;

use App\Models\Short;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ShortsController extends Controller
{
    public function redirect (Short $hash)
    {
        if (! $hash->enabled) abort(404);

        return Redirect::to($hash->url);
    }

    public function view ()
    {
        return Inertia::render('CreateShort');
    }

    public function edit (Short $short)
    {
        return Inertia::render('UpdateShort', [
            'short' => $short
        ]);
    }

    public function create (Request $request)
    {
        $request->filled('hash') || $request['hash'] = bin2hex(random_bytes(5));

        Auth::user()->shorts()->create($request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'hash' => 'nullable|max:255|alpha_dash|unique:shorts'
        ]));

        return Inertia::render('CreateShort');
    }

    public function update (Request $request, Short $short)
    {
        if (Auth::id() !== $short->user_id) abort(403);

        $short->update($request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'enabled' => 'nullable|boolean'
        ]));

        return Inertia::render('UpdateShort', [
            'short' => Short::where('hash', $short->hash)->first()
        ]);
    }

    public function delete (Short $short)
    {
        Auth::id() === $short->user_id && $short->delete();

        return Inertia::render('UpdateShort');
    }

    public function create_api (Request $request)
    {
        if (! ($user = User::where('api_token', $request->api_token)->first())) {
            return response()->json(
                ['msg' => 'Invalid API token!'],
                401,
            );
        }

        $user->shorts()->create([
            'title' => $request->title,
            
            ...$request->validate([
                'title' => 'required|max:255',
                'url' => 'required|url',
            ]),
        ]);

        return response()->json(
            ['msg' => 'Link created successfully'],
            201,
        );
    }
}
