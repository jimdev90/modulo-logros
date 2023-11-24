<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplosivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explosives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_type_explosive');
            $table->decimal('quantity');
            $table->date('date_create');
            $table->time('time_create');
            $table->string('cod_uni1');
            $table->string('user_create');
            $table->string('user_delete')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('explosives');
    }
}
