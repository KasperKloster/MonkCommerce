<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonkcommerceProdImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mc_prod_images', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('product_id')->unsigned();
        $table->foreign('product_id')->references('id')->on('mc_products')->onDelete('cascade');
        $table->string('filename');
        $table->boolean('main')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mc_prod_images');
    }
}
