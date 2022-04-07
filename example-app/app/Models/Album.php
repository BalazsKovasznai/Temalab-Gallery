<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }
    public function shared_with()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'user_album_sharing',
            'album_id',
            'user_id'
        );
    }




    use HasFactory;
}
