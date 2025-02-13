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
        Schema::create('nws', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->date('date');
            $table->string('vedio')->nullable();
            $table->string('img_view');
            $table->string('img_article');
            $table->text('text_ar');
            $table->text('text_en')->nullable();
            $table->string('keyword_ar');
            $table->string('keyword_en')->nullable();
            $table->integer('visit')->default(0);
            $table->foreignId('statu_id')->nullable()->constrained('status')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('new_place_id')->nullable()->constrained('new_places')->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained('publishers')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nws');
    }
};
