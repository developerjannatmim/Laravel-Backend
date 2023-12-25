<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
     * Run the migrations.
     */
  public function up(): void
  {
    Schema::disableForeignKeyConstraints();
    Schema::table('marks', function (Blueprint $table) {
      $table->dropForeign(['exam_id']);
      $table->dropColumn('exam_id');
    });
  }

  /**
     * Reverse the migrations.
     */
  public function down(): void
  {
  Schema::table('test', function (Blueprint $table) {
    $table->foreignId('exam_id')
      ->after('id')
      ->nullable()
      ->constrained();
  });
  }
};
