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
        Schema::table('videos', function (Blueprint $table) {
        $table->string('original_path')->nullable()->after('vedio');
        $table->string('hls_path')->nullable()->after('original_path');
        $table->string('status')->default('pending')->after('hls_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
                    $table->dropColumn(['original_path', 'hls_path', 'status']);

        });
    }
};
