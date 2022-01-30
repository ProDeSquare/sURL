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
        return Inertia::render('Saved/CreateSave');
    }

    public function save (Request $request)
    {
        Auth::user()->saves()->create($request->validate([
            'title' => 'required|string',
            'url' => 'required|url',
        ]));

        return Inertia::render('Saved/CreateSave');
    }

    public function delete (Save $save)
    {
        Auth::id() === $save->user_id && $save->delete();

        return Inertia::render('Saved/Index', [
            'saves' => Auth::user()->saves()->orderBy('created_at', 'desc')->paginate(12),
        ]);
    }
}
