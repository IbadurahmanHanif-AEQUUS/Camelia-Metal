<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->date('date');
            $table->string('shift_1');
            $table->string('shift_2');
            $table->string('shift_3');
            $table->timestamps();

            $table->foreign('machine_id')->references('id')->on('machines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
