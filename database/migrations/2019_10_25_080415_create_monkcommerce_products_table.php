<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonkCommerceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('description')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('special_price')->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('mc_products');
    }
}
