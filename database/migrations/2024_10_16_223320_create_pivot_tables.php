<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('catalog_song', function (Blueprint $table) {
      $table->id();
      $table->foreignId('catalog_id')->constrained()->onDelete('cascade');
      $table->foreignId('song_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });

    Schema::create('playlist_song', function (Blueprint $table) {
      $table->id();
      $table->foreignId('playlist_id')->constrained()->onDelete('cascade');
      $table->foreignId('song_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });

    Schema::create('dj_events', function (Blueprint $table) {
      $table->id();
      $table->foreignId('event_id')->constrained()->onDelete('cascade');
      $table->foreignId('dj_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('dj_events');
    Schema::dropIfExists('playlist_song');
    Schema::dropIfExists('catalog_song');
  }
};
