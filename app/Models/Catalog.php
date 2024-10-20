<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Catalog extends Model
{
  use HasFactory;

  protected $fillable = [
    'dj_id',
    'name',
  ];

  public function dj(): BelongsTo
  {
    return $this->belongsTo(DJ::class);
  }

  public function songs()
  {
    return $this->belongsToMany(Song::class, 'catalog_song');
  }
}
