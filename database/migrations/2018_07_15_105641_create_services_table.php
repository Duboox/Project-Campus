<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_delivery');
            $table->date('date_return');
            $table->timestamps();
            $table->softDeletes();

            // Relations
            $table->integer('id_client')->unsigned();
            $table->foreign('id_client')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')
                    ->references('id')
                    ->on('products')
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
        Schema::dropIfExists('services');
    }
}
