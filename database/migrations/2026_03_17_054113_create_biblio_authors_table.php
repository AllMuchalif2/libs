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
        Schema::create('biblio_authors', function (Blueprint $table) {
            $table->foreignId('biblio_id')->constrained('biblios', 'biblio_id')->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('mst_authors', 'author_id')->cascadeOnDelete();
            $table->primary(['biblio_id', 'author_id']);
            // Pivot tables usually don't need these unless explicitly requested, but db_plan.sql only specifies primary key.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biblio_authors');
    }
};
