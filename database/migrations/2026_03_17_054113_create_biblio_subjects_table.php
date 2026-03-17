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
        Schema::create('biblio_subjects', function (Blueprint $table) {
            $table->foreignId('biblio_id')->constrained('biblios', 'biblio_id')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('mst_subjects', 'subject_id')->cascadeOnDelete();
            $table->primary(['biblio_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biblio_subjects');
    }
};
