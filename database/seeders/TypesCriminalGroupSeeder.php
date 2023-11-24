<?php

namespace Database\Seeders;

use App\Models\TypeCriminalGroup;
use Illuminate\Database\Seeder;

class TypesCriminalGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCriminalGroup::create([
            'name' => 'ORGANIZACIÓN CRIMINAL'
        ]);

        TypeCriminalGroup::create([
            'name' => 'BANDA CRIMINAL'
        ]);
    }
}
