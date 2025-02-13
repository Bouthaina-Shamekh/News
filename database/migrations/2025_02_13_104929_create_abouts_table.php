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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('about_ar');
            $table->text('about_en');
            $table->text('objective_ar');
            $table->text('objective_en');
            $table->text('mission_ar');
            $table->text('mission_en');
            $table->text('vission_ar');
            $table->text('vission_en');
            $table->text('goal_ar');
            $table->text('goal_en');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
