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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_type_id')->constrained('expense_types')->onDelete('cascade');
            $table->integer('annee');
            $table->integer('mois');
            $table->decimal('montant', 10, 2);
            $table->text('detail')->nullable();
            $table->string('nature_depense');
            $table->string('facture_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Down.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
