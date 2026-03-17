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
        Schema::create('biblio_topics', function (Blueprint $table) {
            $table->foreignId('biblio_id')->constrained('biblios', 'biblio_id')->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained('mst_topics', 'topic_id')->cascadeOnDelete();
            $table->primary(['biblio_id', 'topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biblio_topics');
    }
};
