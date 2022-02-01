<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view ()
    {
        return Inertia::render('Dashboard', [
            'shorts' => Auth::user()
                        ->shorts()
                        ->orderBy('created_at', 'desc')
                        ->paginate(12)
        ]);
    }
}
