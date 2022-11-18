<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workorder_id');
            $table->bigInteger('bundle_num');
            $table->unsignedBigInteger('coil_num');
            $table->string('dies_num');
            // $table->string('area');
            $table->decimal('diameter_ujung');
            $table->decimal('diameter_tengah');
            $table->decimal('diameter_ekor');
            $table->string('kelurusan_aktual');
            $table->decimal('panjang_aktual');
            $table->bigInteger('berat_fg');
            $table->bigInteger('pcs_per_bundle');
            $table->boolean('bundle_judgement');
            $table->string('visual');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();

            $table->foreign('workorder_id')->references('id')->on('workorders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('coil_num')->references('id')->on('smeltings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('edited_by')->references('id')->on('users')
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
        Schema::dropIfExists('productions');
    }
}
