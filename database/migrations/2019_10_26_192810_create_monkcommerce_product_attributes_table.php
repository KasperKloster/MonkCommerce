<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonkcommerceProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monkcommerce_product_attributes', function (Blueprint $table) {
          $table->bigIncrements('id');
          // $table->string('code')->unique();
          $table->string('name')->unique();
          // $table->enum('frontend_type', ['select', 'radio', 'text', 'text_area']);
          // $table->boolean('is_filterable')->default(0);
          // $table->boolean('is_required')->default(0);
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
        Schema::dropIfExists('monkcommerce_product_attributes');
    }
}
