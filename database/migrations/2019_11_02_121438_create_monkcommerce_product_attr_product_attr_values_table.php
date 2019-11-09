<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonkcommerceProductAttrProductAttrValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_prod_attr_prod_values', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('product_attribute_id')->unsigned();
          $table->foreign('product_attribute_id')->references('id')->on('mc_prod_attr')->onDelete('cascade');
          $table->integer('product_attribute_value_id')->unsigned();
          $table->foreign('product_attribute_value_id')->references('id')->on('mc_prod_attr_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mc_prod_attr_prod_values');
    }
}
