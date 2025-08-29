<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * UP.
     */
    public function up(): void
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appartement_id')->constrained('appartements')->onDelete('cascade');
            $table->integer('mois');
            $table->integer('annee');
            $table->decimal('montant_appartement', 10, 2)->default(0);
            $table->decimal('montant_garage', 10, 2)->default(0);
            $table->decimal('montant_boxe', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Down.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
