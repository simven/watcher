<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreSerieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_serie', function (Blueprint $table) {
            $table->bigInteger('serie_id')->unsigned();
            $table->bigInteger('genre_id')->unsigned();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_serie');
    }
}
