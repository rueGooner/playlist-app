<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DJ extends Model
{
  protected $table = 'djs';
  protected $fillable = ['user_id', 'catalog_name'];

  use HasFactory;

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function catalog(): HasOne
  {
    return $this->hasOne(Catalog::class);
  }

  public function events(): BelongsToMany
  {
    return $this->belongsToMany(Event::class, 'dj_event');
  }
}
