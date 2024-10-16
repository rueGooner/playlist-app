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
    // Validate the incoming request data
    $request->validate([
      'catalog_name' => 'required|unique:catalogs,name|max:255',
      'file_upload' => 'required|file|mimes:csv,txt',
    ]);

    // Store the uploaded file temporarily
    $temporaryPath = $request->file('file_upload')->store('private/temp');
    $fullPath = storage_path("app/private/{$temporaryPath}");

    // Open the file for reading
    $file = fopen($fullPath, 'r');

    // Skip the CSV header row
    fgetcsv($file);

    // Initialize an empty array to store rows
    $rows = [];

    // Create a new catalog with the given name
    $catalog = Catalog::create(['name' => $request->catalog_name]);

    // Loop through each row in the CSV
    while (($row = fgetcsv($file)) !== false) {
      // Ensure that the row has the expected number of columns (5 in this case)
      if (count($row) === 5) {
        // Check if the song already exists in the DB (deduplication)
        $existingSong = Song::where('track_name', $row[0])
          ->where('artist', $row[1])
          ->where('album_name', $row[2])
          ->first();

        // If the song doesn't exist, add it to the rows array
        if (!$existingSong) {
          $rows[] = [
            'track_name' => $row[0],
            'artist' => $row[1],
            'album_name' => $row[2],
            'genre' => $row[3],
            'released_date' => $row[4],
            'catalog_id' => $catalog->id,
          ];
        } else {
          Log::info('Duplicate song found and skipped', ['track_name' => $row[0], 'artist' => $row[1]]);
        }
      } else {
        // Log or handle the row that doesn't meet criteria
        Log::warning('Invalid row format', ['row' => $row]);
      }
    }

    // Debugging: Log the number of rows collected
    Log::info('Number of valid rows to insert: ' . count($rows));

    // Insert all valid rows into the database at once
    if (!empty($rows)) {
      $newSongIds = Song::insertGetId($rows);

      foreach ($newSongIds as $songId) {
        $catalog->songs()->syncWithoutDetaching([$songId]);
      }
    } else {
      Log::warning('No new songs found to insert');
    }

    // Close the file
    fclose($file);

    // Redirect back to the catalog index with success message
    return redirect()->route('catalogue.index')->with('success', 'New Catalog Uploaded');
  }

}
