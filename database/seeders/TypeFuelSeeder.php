<?php

namespace Database\Seeders;

use App\Models\TypeFuel;
use Illuminate\Database\Seeder;

class TypeFuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeFuel::create([
            'name' => 'PETROLEO'
        ]);
        TypeFuel::create([
            'name' => 'GASOLINA'
        ]);
    }
}
