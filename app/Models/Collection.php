<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function shorts ()
    {
        return $this->hasMany(Short::class, 'collection_id');
    }

    public function saves ()
    {
        return $this->hasMany(Save::class, 'collection_id');
    }

    public static function cacheId (): string
    {
        return sha1(Auth::user()->email) . "-collection";
    }
}
