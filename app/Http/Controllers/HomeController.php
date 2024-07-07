<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view (Request $request, $collection = null)
    {
        $shorts = $this->getShorts($collection, $request->sort);

        $shorts->getCollection()->transform(function ($short) {
            $short->clicks = $short->getClicksCount();
            return $short;
        });

        return Inertia::render('Dashboard', [
            'shorts' => $shorts,

            'collections' => cache()->remember(
                Collection::cacheId(),
                config('cache.default-period'),
                fn () =>
                    Auth::user()->collections()->orderBy('name')->get()
            ),
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

        return $base->shorts();
    }

    protected function getSorted ($base, $sort)
    {
        return $sort === 'newest'
            ? $base->latest()
            : $base->orderBy('title');
    }
}
