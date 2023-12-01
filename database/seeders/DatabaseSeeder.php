<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Problem;
use App\Models\Suggestion;
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

        $suggestion = Suggestion::create([
            'author_id' => 31999873,
            'title' => 'My first Suggestion',
            'slug' => 'my-first-suggestion',
            'content' => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores aut commodi consequuntur corporis excepturi expedita harum, in minus molestiae molestias officiis perspiciatis placeat provident quam tempore ut vel veritatis!</p>"
        ]);

        Comment::factory()->create([
           'author_id' => 31999873,
           'commentable_id' => $suggestion->id,
           'commentable_type' => Suggestion::class
        ]);

        Comment::factory()->create([
            'author_id' => 31997791,
            'commentable_id' => $suggestion->id,
            'commentable_type' => Suggestion::class,
            'parent_id' => 1,
        ]);
        Comment::factory()->create([
            'author_id' => 31983697,
            'commentable_id' => $suggestion->id,
            'commentable_type' => Suggestion::class,
            'parent_id' => 2,
        ]);

        $problem = Problem::create([
            'author_id' => 31999873,
            'title' => 'My first Problem',
            'slug' => 'my-first-problem',
            'content' => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores aut commodi consequuntur corporis excepturi expedita harum, in minus molestiae molestias officiis perspiciatis placeat provident quam tempore ut vel veritatis!</p>"
        ]);

        Comment::factory()->create([
            'author_id' => 31999873,
            'commentable_id' => $problem->id,
            'commentable_type' => Problem::class
        ]);

        Comment::factory()->create([
            'author_id' => 31997791,
            'commentable_id' => $problem->id,
            'commentable_type' => Problem::class,
            'parent_id' => 4,
        ]);
        Comment::factory()->create([
            'author_id' => 31983697,
            'commentable_id' => $problem->id,
            'commentable_type' => Problem::class,
            'parent_id' => 5,
        ]);
    }
}
