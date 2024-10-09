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
    Schema::create('songs_playlist_pivot', function (Blueprint $table) {
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
    Schema::dropIfExists('songs_playlist_pivot');
  }
};
