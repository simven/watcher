<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->bigInteger('serie_id')->unsigned();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');
            $table->text('resume')->nullable();
            $table->integer('numero');
            $table->integer('saison');
            $table->integer('duree');
            $table->date('premiere')->nullable();
            $table->string('urlImage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
