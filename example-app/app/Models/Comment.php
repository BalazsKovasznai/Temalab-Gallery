<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function Photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }
    use HasFactory;
}
