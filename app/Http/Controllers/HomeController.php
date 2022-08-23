<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // "base" would help to eliminate duplication
    // "sort" can later be used to fetch newest links
    private $base,
            $sort = 'title';

    public function view ($collection = null)
    {
        $this->setBase($collection);

        $shorts = $this->base->shorts()->with('clicks')->orderBy($this->sort)->paginate(12);

        return Inertia::render('Dashboard', [
            'shorts' => $shorts,

            'collections' => Auth::user()
                            ->collections()
                            ->orderBy('name')
                            ->get(),
        ]);
    }

    protected function setBase ($collection)
    {
        $this->base = $collection
            ? Auth::user()->collections()->findOrFail($collection)
            : Auth::user();
    }
}
