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
        Schema::create('campables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('camp_id');
            $table->unsignedBigInteger('campable_id');
            $table->string('campable_type');
            $table->string('type')->nullable();
            $table->timestamps();

            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campables');
    }
};
