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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('cedula')->nullable();
            $table->string('rif')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('correo')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('titulo')->nullable();
            $table->string('dr_titulo')->nullable();
            $table->string('mpps')->nullable();
            $table->string('cmt')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
