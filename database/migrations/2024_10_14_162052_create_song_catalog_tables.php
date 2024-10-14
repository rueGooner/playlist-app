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
    Schema::create('catalogs', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->timestamps();
    });

    Schema::create('playlists', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignId('event_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });

    Schema::create('songs', function (Blueprint $table) {
      $table->id();
      $table->string('track_name');
      $table->string('artist');
      $table->string('album_name');
      $table->string('genre');
      $table->foreignId('catalog_id')->nullable()->constrained('catalogs')->nullOnDelete();
      $table->string('released_date');
    });

    Schema::create('playlist_song_pivot', function (Blueprint $table) {
      $table->id();
      $table->foreignId('playlist_id')->constrained()->onDelete('cascade');
      $table->foreignId('song_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('playlist_song_pivot');
    Schema::dropIfExists('playlists');
    Schema::dropIfExists('songs');
    Schema::dropIfExists('catalogs');
  }
};
