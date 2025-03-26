<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('nombres')->nullable();
            $table->string('cedula')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('edad')->nullable();
            $table->string('genero')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('responsable')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
