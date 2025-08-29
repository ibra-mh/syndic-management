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
