<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonkCommerceCreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('monkcommerce_product_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->comment('Main category name');
          $table->string('slug')->unique()->nullable();
          $table->string('description')->nullable()->comment('Main category description');
          $table->boolean('show_in_menu')->nullable()->comment('Show in frontend menu');
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
        Schema::dropIfExists('monkcommerce_product_categories');
    }
}
