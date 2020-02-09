<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcOrdersTable extends Migration
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
        $table->unsignedInteger('order_status_id')->default('1');
        $table->unsignedBigInteger('order_customer_id')->nullable();
        $table->unsignedBigInteger('order_customer_delivery_id')->nullable();
        $table->unsignedInteger('shipping')->nullable();
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
