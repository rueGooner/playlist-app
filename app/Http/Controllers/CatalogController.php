<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CatalogController extends Controller
{
  /*
 * Display a listing of all events on /events page.
 */
  public function index()
  {
    if (!Gate::allows('catalog')) {
      return redirect()->route('home')->with('error', 'Unauthorised access.');
    }

    $catalog = Catalog::with('user')->orderBy('created_at', 'desc')->get();

    return Inertia::render('Catalogue/Index', [
      'catalog' => $catalog,
    ]);
  }
}
