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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->foreignId('biblio_id')->constrained('biblios', 'biblio_id')->cascadeOnDelete();
            $table->string('item_code', 50);
            $table->foreignId('location_id')->constrained('mst_locations', 'location_id')->restrictOnDelete();
            $table->foreignId('coll_type_id')->constrained('mst_coll_type', 'coll_type_id')->restrictOnDelete();
            $table->enum('status', ['Dipinjam', 'Rusak', 'Hilang', 'Tersedia'])->default('Tersedia');
            $table->string('call_number', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
