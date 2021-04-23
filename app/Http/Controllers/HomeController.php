<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view ()
    {
        return Inertia::render('Dashboard', [
            'links' => Auth::user()->links()->paginate()
        ]);
    }
}
