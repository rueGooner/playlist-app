<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DJController extends Controller
{
  /**
   * Create a New DJ
   */
  public function createDJ(int $userId, string $catalogName)
  {
    return DJ::create([
      'user_id' => $userId, // I'm asking if this should just be 'id' => $userId
      'catalog_name' => $catalogName,
    ]);
  }
}
