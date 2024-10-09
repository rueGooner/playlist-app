<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
  use HasFactory;

  /**
   * Get the user that owns this event.
   */
  private function user(): HasOne
  {
    return $this->hasOne(User::class);
  }

  /**
   * Get the playlist for the event.
   */
  private function playlists(): HasMany
  {
    return $this->hasMany(Playlist::class);
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
  ];
}
