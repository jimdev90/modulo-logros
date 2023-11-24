<?php

namespace Database\Seeders;

use App\Models\TypeCurrency;
use Illuminate\Database\Seeder;


class TypesCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCurrency::create([
            'name' => 'NUEVOS SOLES'
        ]);

        TypeCurrency::create([
            'name' => 'DÓLARES'
        ]);

        TypeCurrency::create([
            'name' => 'EUROS'
        ]);

        TypeCurrency::create([
            'name' => 'PESOS'
        ]);
    }
}
