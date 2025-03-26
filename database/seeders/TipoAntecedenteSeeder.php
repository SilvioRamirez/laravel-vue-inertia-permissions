<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoAntecedente;
class TipoAntecedenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoAntecedentes = [
            'cardiovascular',
            'metabolica',
            'quirurgica',
            'enfermedad_renal',
            'musculoesqueleto',
            'alergia',
            'tabaco',
            'alcohol',
            'otro',
        ];

        // Looping and Inserting Array's tipoAntecedentes into TipoAntecedente Table
        foreach ($tipoAntecedentes as $tipoAntecedente) {
            TipoAntecedente::create(['nombre' => $tipoAntecedente]);
        }
    }
}
