<?php

namespace Database\Seeders;

use App\Models\TypeCurrency;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypesCriminalGroupSeeder::class,
            TypesCurrencySeeder::class,
            TypesDrugSeeder::class,
            TypesExplosiveSeeder::class,
            TypesFireArmSeeder::class,
            TypesOtherSeeder::class,
            TypesPersonSeeder::class,
            TypeFuelSeeder::class,
            UnidadSeeder::class,
        ]);
    }
}
