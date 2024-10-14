<?php

namespace App\Http\Controllers;

use App\Imports\SongImport;
use App\Models\Catalog;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadsController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'catalog_name' => 'required|unique:catalogs,name|max:255',
      'file_upload' => 'required|file|mimes:csv,txt',
    ]);

    $temporaryPath = $request->file('file_upload')->store('private/temp');
    $fullPath = storage_path("app/private/{$temporaryPath}");
    $file = fopen($fullPath, 'r');

    fgetcsv($file);

    $rows = [];
    $catalog = Catalog::create(['name' => $request->catalog_name]);

    while (($row = fgetcsv($file)) !== false) {
      while (($row = fgetcsv($file)) !== false) {
        // Ensure that the row has the expected number of columns
        if (count($row) === 5) { // Expecting 5 columns
          $rows[] = [
            'track_name' => $row[0],
            'artist' => $row[1],
            'album_name' => $row[2],
            'genre' => $row[3],
            'released_date' => $row[4],
            'catalog_id' => $catalog->id,
          ];
        } else {
          // Log or handle the row that doesn't meet criteria
          Log::warning('Invalid row format', ['row' => $row]);
        }
      }

      // Debugging: Log the number of rows collected
      Log::info('Number of rows to insert: ' . count($rows));

      // Insert all rows into the database at once
      if (!empty($rows)) {
        Song::insert($rows);
      } else {
        Log::warning('No valid rows found to insert');
      }

      // Close the file
      fclose($file);

      return redirect()->route('catalogue.index')->with('success', 'New Catalog Uploaded');
    }
  }
}
