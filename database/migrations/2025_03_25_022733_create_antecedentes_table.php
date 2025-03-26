<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Paciente;
use App\Models\TipoAntecedente;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Paciente::class)->nullable();
            $table->foreignIdFor(TipoAntecedente::class)->nullable();
            $table->string('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes');
    }
};
