<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Producto;
use App\Models\TipoCita;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Paciente::class)->nullable();
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->foreignIdFor(Producto::class)->nullable();
            $table->foreignIdFor(TipoCita::class)->nullable();
            $table->string('title')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->string('color')->nullable();
            $table->string('backgroundColor')->nullable();
            $table->string('borderColor')->nullable();
            $table->string('textColor')->nullable();
            $table->string('allday')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
