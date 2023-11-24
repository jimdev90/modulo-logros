<?php

namespace Database\Seeders;

use App\Models\TypeExplosive;
use Illuminate\Database\Seeder;

class TypesExplosiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeExplosive::create([
            'name' => 'DINAMITA'
        ]);
        TypeExplosive::create([
            'name' => 'ARTEFACTOS PIROTÉCNICOS'
        ]);
    }
}
