<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Paciente;
use App\Models\Doctor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Paciente::class)->nullable();
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->text('evaluacion')->nullable();
            $table->text('observacion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
