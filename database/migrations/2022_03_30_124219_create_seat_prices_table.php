<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room_type_id')->unsigned();            
            $table->bigInteger('seat_type_id')->unsigned();            
            $table->decimal('price', 10, 0);
            $table->timestamps();
            $table->foreign('room_type_id')
                ->references('id')->on('room_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('seat_type_id')
                ->references('id')->on('seat_types')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('seat_prices');
    }
}
