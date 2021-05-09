<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario')->references('id')->on('users')->onDelete("cascade");
            $table->foreignId('album')->references('id')->on('album')->onDelete("cascade");
            $table->string('review')->nullable(false);
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
        Schema::dropIfExists('Review');
    }
}
