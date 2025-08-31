<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Up.
     */
    public function up(): void
    {
        Schema::create('immeubles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_immeuble');
            $table->foreignId('tranche_id')->constrained('tranches')->onDelete('cascade');
            $table->integer('nombre_etages')->default(1);
            $table->integer('nombre_appartements')->default(1);
            $table->text('description')->nullable();
            $table->enum('status', ['actif', 'inactif'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Down.
     */
    public function down(): void
    {
        Schema::dropIfExists('immeubles');
    }
};
