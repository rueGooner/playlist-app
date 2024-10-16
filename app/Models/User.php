<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $role // Adding this line for IDE support
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable
{
  use HasFactory, Notifiable;

  const ROLE_ADMIN = 'admin';
  const ROLE_DJ = 'dj';
  const ROLE_CLIENT = 'client';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'first_name',
    'last_name',
    'email',
    'password',
    'role'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   *
   * @return HasMany
   */
  public function events(): HasMany
  {
    return $this->hasMany(Event::class);
  }

  /**
   *
   * @return HasMany
   */
  public function playlists(): HasMany
  {
    return $this->hasMany(Playlist::class);
  }

  public function isAdmin(): bool
  {
    return $this->role === self::ROLE_ADMIN;
  }

  public function isDJ(): bool
  {
    return $this->role === self::ROLE_DJ;
  }

  public function isClient(): bool
  {
    return $this->role === self::ROLE_CLIENT;
  }
}
