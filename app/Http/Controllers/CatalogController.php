<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CatalogController extends Controller
{
  protected $fillable = [
    'dj_id',
    'name',
  ];

  /*
 * Display a listing of all events on /events page.
 */
  public function index()
  {
    if (!Gate::allows('catalog')) {
      return redirect()->route('home')->with('error', 'Unauthorised access.');
    }

    $catalog = Catalog::orderBy('created_at', 'desc')->get();

    return Inertia::render('Catalogue/Index', [
      'catalog' => $catalog,
    ]);
  }

  /**
   * Create a New Catalog
   */
  public function createCatalog(int $userId, string $catalogName)
  {
    return Catalog::create([
      'dj_id' => $userId,
      'name' => $catalogName,
    ]);
  }
}
