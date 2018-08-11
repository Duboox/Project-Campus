<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('model');
            $table->string('serial_number');
            $table->string('internal_code');
            $table->string('magnitude');
            $table->date('date_last_calibration');
            $table->date('date_control_calibration');
            $table->tinyInteger('delivery_status');
            $table->tinyInteger('status');
            $table->string('others')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Relations
            $table->integer('id_fabricator')->unsigned();
            $table->foreign('id_fabricator')
                    ->references('id')
                    ->on('fabricators')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
