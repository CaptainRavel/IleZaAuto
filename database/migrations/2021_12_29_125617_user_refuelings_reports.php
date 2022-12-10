<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRefuelingsReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_refuels', function (Blueprint $table) {
            $table->id('refueling_id');
            $table->bigInteger('user_id');
            $table->float('fuel'); 
            $table->float('price'); 
            $table->date('refueling_date'); 
            $table->float('distance'); 
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
        Schema::dropIfExists('user_refuels');
    }
}
