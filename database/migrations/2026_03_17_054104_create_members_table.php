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
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('member_code', 30)->unique();
            $table->string('password');
            $table->foreignId('member_type_id')->constrained('member_types', 'member_type_id')->restrictOnDelete();
            $table->string('name', 100);
            $table->enum('gender', ['L', 'P']);
            $table->string('faculty', 100);
            $table->string('study_program', 100);
            $table->string('whatsapp_number', 20);
            $table->text('address');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
