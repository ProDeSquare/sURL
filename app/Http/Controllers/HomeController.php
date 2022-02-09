<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view ($collection = null)
    {
        $shorts = $collection
            ? Auth::user()->collections()->findOrFail($collection)->shorts()->orderBy('title')->paginate(12)
            : Auth::user()->shorts()->orderBy('title')->paginate(12);

        return Inertia::render('Dashboard', [
            'shorts' => $shorts,

            'collections' => Auth::user()
                            ->collections()
                            ->orderBy('name')
                            ->get(),
        ]);
    }
}
