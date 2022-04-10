<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatColsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_cols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seat_row_id')->unsigned();            
            $table->integer('status');
            $table->timestamps();
            $table->string('seat_name');
            $table->foreign('seat_row_id')
                ->references('id')->on('seat_rows')
                ->onUpdate('cascade')
                ->onDelete('cascade');
           
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
        Schema::dropIfExists('seat_cols');
    }
}
