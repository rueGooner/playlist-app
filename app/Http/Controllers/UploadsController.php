<?php

namespace App\Http\Controllers;

use App\Imports\SongImport;
use App\Models\Catalog;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'catalog_name' => 'required|unique:catalogs,name|max:255',
      'csv_file' => 'required|mimes:csv',
    ]);

    $catalog = Catalog::create([ 'name' => $request->catalog_name]);

    $file = $request->file('csv_file');

    Excel::import(new SongImport($catalog->id), $file);

    return redirect()->route('dashboard')->with('success', 'New Catalog Uploaded');
  }
}
