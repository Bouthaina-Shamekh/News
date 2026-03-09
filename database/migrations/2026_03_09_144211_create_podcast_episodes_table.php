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
        Schema::create('podcast_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->enum('type', ['audio', 'video'])->nullable();
            $table->string('vedio')->nullable();
            $table->string('audio')->nullable();
            $table->string('img_view')->nullable();
            $table->string('img_episode')->nullable();
            $table->text('text_ar')->nullable();
            $table->text('text_en')->nullable();
            $table->string('keyword_ar')->nullable();
            $table->string('keyword_en')->nullable();
            $table->foreignId('podcast_id')->nullable()->constrained('podcasts')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast_episodes');
    }
};
