<?php

namespace App\Http\Controllers;

use App\Models\DJ;

class DJController extends Controller
{
  /**
   * Create a New DJ
   */
  public function createDJ(int $userId, string $catalogName)
  {
    return DJ::create([
      'user_id' => $userId,
      'catalog_name' => $catalogName,
    ]);
  }
}
