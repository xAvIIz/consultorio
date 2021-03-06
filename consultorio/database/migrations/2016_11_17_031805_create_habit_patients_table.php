<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habit_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('habit_frecuency',['DAY','HALFDAY','WEEK','MONTH','YEAR'])->nullable();
            $table->float('habit_lot', 7, 3);
            $table->enum('units',['MINUTE','HOUR'])->nullable();
            $table->integer('habit_id')->unsigned();
            $table->foreign('habit_id')->references('id')->on('habits')->onDelete('cascade');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('habit_patients');
    }
}
