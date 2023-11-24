<?php

namespace Database\Seeders;

use App\Models\TypeOther;
use Illuminate\Database\Seeder;

class TypesOtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOther::create([
            'name' => 'BIENES MUEBLES INCAUTADOS'
        ]);

        TypeOther::create([
            'name' => 'BIENES INMUEBLES INCAUTADOS'
        ]);

        TypeOther::create([
            'name' => 'MADERA'
        ]);

        TypeOther::create([
            'name' => 'MERCADERÍA DE CONTRABANDO'
        ]);

    }
}
