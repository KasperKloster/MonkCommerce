<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonkcommerceProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monkcommerce_product_attribute_values', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('attribute_id');
          $table->foreign('attribute_id')->references('id')->on('monkcommerce_product_attributes');
          $table->text('value');
          $table->decimal('price', 2)->nullable();
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
        Schema::dropIfExists('monkcommerce_product_attribute_values');
    }
}
