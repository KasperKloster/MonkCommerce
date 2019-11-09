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
      Schema::create('mc_product_categories', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name')->comment('Main category name');
          $table->string('slug')->unique()->nullable();
          $table->string('description')->nullable()->comment('Main category description');
          $table->boolean('show_in_menu')->nullable()->comment('Show in frontend menu');
          $table->unsignedBigInteger('category_id')->nullable();
          $table->foreign('category_id')->references('id')->on('mc_product_categories')->onDelete('cascade');
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
        Schema::dropIfExists('mc_product_categories');
    }
}
