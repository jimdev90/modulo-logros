<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('idusuarios');
            $table->unsignedBigInteger('id_unidad');
            $table->enum('state', ['active', 'inactive'])->default('active');
            $table->string('profile')->default(1);
            $table->string('user_create');
            $table->string('user_update')->nullable();
            $table->string('user_delete')->nullable();
            $table->unique(['idusuarios', 'id_unidad']);
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
        Schema::dropIfExists('unidades_usuarios');
    }
}
