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
    Schema::table('events', function (Blueprint $table) {
      $table->string('title');
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->date('event_date');
      $table->dateTime('start_time');
      $table->dateTime('end_time');
      $table->string('address');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('events', function (Blueprint $table) {
      $table->dropColumn('title');
      $table->dropForeign('user_id');
      $table->dropColumn('event_date');
      $table->dropColumn('start_time');
      $table->dropColumn('end_time');
      $table->dropColumn('address');
    });
  }
};
