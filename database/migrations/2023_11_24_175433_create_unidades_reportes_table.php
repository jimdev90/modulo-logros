<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_unidad');
            $table->dateTime('date_init');
            $table->dateTime('date_finish');
            $table->string('user_init');
            $table->char('status')->default('1');
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
        Schema::dropIfExists('unidades_reportes');
    }
}
