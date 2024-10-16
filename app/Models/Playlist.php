<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'event_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function event()
  {
    return $this->belongsTo(Event::class);
  }

  public function songs()
  {
    return $this->belongsToMany(Song::class, 'playlist_song_pivot')->withTimestamps();
  }
}
