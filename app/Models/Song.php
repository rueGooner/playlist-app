<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
      'track_name',
      'artist',
      'album',
      'genre',
      'catalog_id',
      'release_date',
    ];

    public function catalog()
    {
      return $this->belongsTo(Catalog::class);
    }

    public function playlists()
    {
      return $this->belongsToMany(Playlist::class, 'playlist_song_pivot')->withTimestamps();
    }
}
