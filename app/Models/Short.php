<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'hash',
        'enabled',
        'collection_id',
    ];

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function clicks()
    {
        return $this->hasMany(Click::class, 'short_id');
    }

    public function getClicksCount(): int
    {
        return cache()->remember(
            sha1($this->id) . "-clicks",
            config('cache.default_period'),
            fn () => $this->clicks()->count(),
        );
    }
}
