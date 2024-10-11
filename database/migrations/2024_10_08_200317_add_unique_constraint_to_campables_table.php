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
        Schema::table('campables', function (Blueprint $table) {
            $table->unique(['camp_id', 'campable_id', 'campable_type'], 'unique_campable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campables', function (Blueprint $table) {
            $table->dropUnique('unique_campable');
        });
    }
};
