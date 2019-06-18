<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title', 'artist', 'genre', 'album', 'albumImageUrl', 'youtubeId', 'lyrics', 'tab'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
}
