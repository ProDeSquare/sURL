<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    public function redirect (Link $hash)
    {
        if (! $hash->enabled) abort(404);

        return Redirect::to($hash->url);
    }
}
