<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
  public function boot(): void
  {
    $this->register();

    Gate::define('events', function ($user) {
      return $user->role === 'admin';
    });
  }
}
