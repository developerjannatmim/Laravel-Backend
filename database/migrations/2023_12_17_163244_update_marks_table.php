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
        Schema::table('marks', function (Blueprint $table) {
            $table->foreignId('exam_category_id')
            ->after('id')
            ->nullable()
            ->constrained();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('marks', function (Blueprint $table) {
          $table->dropForeign(['exam_category_id']);
        });
    }
};