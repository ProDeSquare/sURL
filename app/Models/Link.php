<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'short_url',
        'enabled'
    ];

    public function getRouteKeyName()
    {
        return 'hash';
    }
}
