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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->string('nom_app');
            $table->foreignId('immeuble_id')->constrained('immeubles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Down.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartements');
    }
};
