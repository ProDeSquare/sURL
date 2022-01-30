<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view ()
    {
        // dd(Auth::user()->shorts()->orderBy('created_at', 'desc')->paginate(12));

        return Inertia::render('Dashboard', [
            'shorts' => Auth::user()
                        ->shorts()
                        ->orderBy('created_at', 'desc')
                        ->paginate(12)
        ]);
    }
}
