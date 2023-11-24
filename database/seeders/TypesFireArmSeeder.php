<?php

namespace Database\Seeders;

use App\Models\TypeFireArm;
use Illuminate\Database\Seeder;


class TypesFireArmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeFireArm::create([
            'name' => 'PISTOLA'
        ]);
        TypeFireArm::create([
            'name' => 'REVOLVER'
        ]);
        TypeFireArm::create([
            'name' => 'FUSILES'
        ]);
        TypeFireArm::create([
            'name' => 'GRANADAS'
        ]);
        TypeFireArm::create([
            'name' => 'CARABINAS'
        ]);
        TypeFireArm::create([
            'name' => 'CARABINAS R15'
        ]);
        TypeFireArm::create([
            'name' => 'ARMAS ARTESANALES'
        ]);
        TypeFireArm::create([
            'name' => 'MUNICIÓN INCAUTADA'
        ]);
    }
}
