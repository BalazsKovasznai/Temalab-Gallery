<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Photo extends Model
{
    public function Album()
    {
        return $this->belongsTo('App\Models\Album');
    }
    use HasFactory;
}
