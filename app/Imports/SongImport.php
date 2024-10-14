<?php

namespace App\Imports;

use App\Models\Song;
use Maatwebsite\Excel\Concerns\ToModel;

class SongImport implements ToModel
{
  protected $catalog_id;

  public function __construct($catalog_id)
  {
    $this->catalog_id = $catalog_id;
  }

  public function model(array $row)
  {
    return new Song([
      'track_name' => $row[1],
      'artist' => $row[2],
      'album_name' => $row[4],
      'genre' => $row[9],
      'released_date' => $row[6],
      'catalog_id' => $this->catalog_id,
    ]);
  }

  public function chunkSize(): int{
    return 500;
  }
}
