<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
  /**
   * Create a New Playlist
   */
  public function createPlaylist(int $userId, string $name)
  {
    return Playlist::create([
      'user_id' => $userId,
      'name' => $name . "'s Playlist.",
    ]);
  }
}
