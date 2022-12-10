<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCarReprairsReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reprairs', function (Blueprint $table) {
            $table->id('reprair_id');
            $table->bigInteger('user_id');
            $table->date('reprair_date'); 
            $table->bigInteger('car_mileage');  
            $table->text('reprair_location');
            $table->text('reprair_subject');
            $table->float('price');  
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
        Schema::dropIfExists('user_reprairs');
    }
}
