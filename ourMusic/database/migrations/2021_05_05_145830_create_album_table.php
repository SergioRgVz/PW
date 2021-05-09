<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Album', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->nullable(false);
            $table->string('artista', 40)->nullable(false);
            $table->date('lanzamiento')->nullable(false);
            $table->float('puntuacion', 4, 2)->nullable();
            $table->string('genero', 50)->nullable(false);
            $table->foreignId('usuario')->references('id')->on('users')->onDelete("cascade");
            $table->string('imagen', 100);
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
        Schema::dropIfExists('Album');
    }
}
