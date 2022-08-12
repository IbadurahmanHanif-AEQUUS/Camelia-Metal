<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->time('break_1_start');
            $table->time('break_1_end');
            $table->time('break_2_start');
            $table->time('break_2_end');
            $table->time('break_3_start');
            $table->time('break_3_end');
            $table->time('break_4_start');
            $table->time('break_4_end');
            $table->time('break_5_start');
            $table->time('break_5_end');
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
        Schema::dropIfExists('shifts');
    }
}
