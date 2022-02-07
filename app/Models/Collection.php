<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
