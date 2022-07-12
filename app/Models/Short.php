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

    public function clicks()
    {
        return $this->hasMany(Click::class, 'short_id');
    }
}
