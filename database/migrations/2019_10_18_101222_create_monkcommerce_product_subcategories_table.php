<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonkCommerceProductSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monkcommerce_product_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Subcategory name');
            $table->string('slug')->unique()->nullable();
            $table->string('description')->nullable()->comment('Main category description');
            $table->unsignedInteger('product_category_id')->default('1');
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
        Schema::dropIfExists('monk_commerce_product_subcategories');
    }
}
