<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
  use HasFactory;

  /**
   * Get the user that owns this event.
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function djs()
  {
    return $this->belongsToMany(DJ::class, 'dj_event');
  }

  /**
   * Get the playlist for the event.
   */
  public function playlists(): HasOne
  {
    return $this->hasOne(Playlist::class);
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'user_id',
    'event_date',
    'start_time',
    'end_time',
    'address',
  ];
}
