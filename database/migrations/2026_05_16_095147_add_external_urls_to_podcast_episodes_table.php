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
        Schema::table('podcast_episodes', function (Blueprint $table) {
            $table->string('audio_url')->nullable()->after('audio');
            $table->string('video_url')->nullable()->after('audio_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcast_episodes', function (Blueprint $table) {
             $table->dropColumn(['audio_url', 'video_url']);
        });
    }
};
