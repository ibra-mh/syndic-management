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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->integer('etage');
            $table->decimal('surface', 8, 2);
            $table->enum('status', ['occupé', 'vacant'])->default('vacant');
            $table->foreignId('immeuble_id')->constrained()->onDelete('cascade');
            $table->foreignId('proprietaire_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartements');
    }
};
