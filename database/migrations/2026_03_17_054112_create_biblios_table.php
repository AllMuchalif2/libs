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
        Schema::create('biblios', function (Blueprint $table) {
            $table->id('biblio_id');
            $table->string('title', 255);
            $table->foreignId('publisher_id')->constrained('mst_publishers', 'publisher_id')->restrictOnDelete();
            $table->foreignId('gmd_id')->constrained('mst_gmds', 'gmd_id')->restrictOnDelete();
            $table->string('isbn_issn', 50)->nullable();
            $table->string('publish_year', 10);
            $table->string('classification', 10);
            $table->string('cover_image', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biblios');
    }
};
