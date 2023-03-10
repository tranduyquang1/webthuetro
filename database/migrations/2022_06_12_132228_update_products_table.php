<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('ram_id', 10)->nullable();
            $table->foreign('ram_id')->references('id')->on('ram');

            $table->string('cpu_id', 15)->nullable();
            $table->foreign('cpu_id')->references('id')->on('cpu');

            $table->string('gpu_id', 15)->nullable();
            $table->foreign('gpu_id')->references('id')->on('gpu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
