<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DJ extends Model
{
  use HasFactory;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function catalog()
  {
    return $this->hasOne(Catalog::class);
  }

  public function events()
  {
    return $this->belongsToMany(Event::class, 'dj_event');
  }
}
