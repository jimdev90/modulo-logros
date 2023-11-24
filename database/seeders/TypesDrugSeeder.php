<?php

namespace Database\Seeders;

use App\Models\TypeDrug;
use Illuminate\Database\Seeder;

class TypesDrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDrug::create([
            'name' => 'CLORHIDRATO CC.'
        ]);

        TypeDrug::create([
            'name' => 'PBC'
        ]);

        TypeDrug::create([
            'name' => 'MARIHUANA'
        ]);
    }
}
