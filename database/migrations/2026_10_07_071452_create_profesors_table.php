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
        Schema::create('profesor', function (Blueprint $table) {
            $table->id();
            $table->String('nombre', 100);
            $table->String('apellido', 130);
            $table->String('asignatura', 130);
            $table->date('fnac')->nullable();
            $table->enum('genero', ['masculino','femenino','otro'])->nullable();
            $table->timestamps();
            $table->unique(['nombre', 'apellido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};
