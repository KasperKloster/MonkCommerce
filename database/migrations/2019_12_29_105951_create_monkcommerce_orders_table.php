<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonkcommerceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mc_orders', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('order_status_id')->default('1');
        $table->unsignedBigInteger('order_customer_id')->default('1');
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
        Schema::dropIfExists('mc_orders');
    }
}