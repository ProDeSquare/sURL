<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view (Request $request, $collection = null)
    {
        return Inertia::render('Dashboard', [
            'shorts' => $this->getShorts($collection, $request->sort),

            'collections' => Auth::user()
                            ->collections()
                            ->orderBy('name')
                            ->get(),
        ]);
    }

    protected function getShorts ($collection, $sort)
    {
        return $this->getSorted($this->getBase($collection), $sort)->paginate(12);
    }

    protected function getBase ($collection)
    {
        $base = $collection
            ? Auth::user()->collections()->findOrFail($collection)
            : Auth::user();
        
        return $base->shorts()->with('clicks');
    }

    protected function getSorted ($base, $sort)
    {
        return $sort === 'newest'
            ? $base->latest()
            : $base->orderBy('title');
    }
}
