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
        Schema::table('test', function (Blueprint $table) {
            $table->foreignId('class_id')
              ->after('id')
              ->nullable()
              ->constrained();
            $table->foreignId('school_id')
              ->after('id')
              ->nullable()
              ->constrained();
          });
    }

    /**
     * Reverse the migrations.
     * How to delete Foreign key.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('test', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropForeign(['school_id']);
            $table->dropColumn(['school_id', 'class_id']);
        });
    }
};
