<?php

namespace Database\Seeders;

use App\Models\TypePerson;
use Illuminate\Database\Seeder;


class TypesPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePerson::create([
            'name' => 'DETENIDOS EXTRANJEROS'
        ]);

        TypePerson::create([
            'name' => 'DETENIDOS NACIONALES'
        ]);

        TypePerson::create([
            'name' => 'DETENIDOS (TERRORISMO)'
        ]);

        TypePerson::create([
            'name' => 'DETENIDOS (TID)'
        ]);

        TypePerson::create([
            'name' => 'CAPTURADOS POR REQUISITORIA'
        ]);

        TypePerson::create([
            'name' => 'MENORES RETENIDOS'
        ]);
    }
}
