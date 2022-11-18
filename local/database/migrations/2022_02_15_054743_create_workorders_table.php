<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();

            $table->string('wo_number')->unique();
            $table->string('bb_supplier');
            $table->string('bb_grade');
            $table->decimal('bb_diameter');
            $table->bigInteger('bb_qty_pcs');
            $table->bigInteger('bb_qty_coil');
            $table->bigInteger('bb_qty_bundle');
            $table->string('fg_customer');
            $table->string('straightness_standard');
            $table->double('fg_size_1',15,2);
            $table->double('fg_size_2',15,2);
            $table->double('tolerance_minus',15,2);
			$table->double('tolerance_plus',15,2);
            $table->double('fg_reduction_rate',15,2);
            $table->string('fg_shape');
            $table->bigInteger('fg_qty_kg');
            $table->bigInteger('fg_qty_pcs');
            $table->bigInteger('wo_order_num')->nullable();
            $table->enum('status_wo',['draft','waiting','on process','on check','closed'])->default('draft');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('process_start')->nullable();
            $table->timestamp('process_end')->nullable();
			$table->string('chamfer');
			$table->unsignedBigInteger('color');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('color')->references('id')->on('colors')
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
        Schema::dropIfExists('workorders');
    }
}
