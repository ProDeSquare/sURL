<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    use HasFactory;

    public static function booted ()
    {
        static::created(fn ($cache) => cache()->forget($cache->cacheId()));

        static::deleted(fn ($cache) => cache()->forget($cache->cacheId()));
    }

    public function short ()
    {
        return $this->belongsTo(Short::class, 'short_id');
    }

    public function cacheId (): string
    {
        return sha1($this->short_id) . "-clicks";
    }
}
