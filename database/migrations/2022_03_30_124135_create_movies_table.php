<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('type', 255);
            $table->string('producer', 255);
            $table->string('country', 255);
            $table->string('cast', 255);
            $table->date('day_start');
            $table->integer('time');
            $table->text('content');
            $table->string('directors', 255);
            $table->string('image', 255);
            $table->string('trailer', 255);
            $table->tinyInteger('status');
            
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
