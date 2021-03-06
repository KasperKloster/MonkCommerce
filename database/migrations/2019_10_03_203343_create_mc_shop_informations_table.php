<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcShopInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mc_shop_informations', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->nullable();
          $table->string('street_address')->nullable()->comment('eg: 1901 Lemur Ave');
          $table->string('postal_code')->nullable()->comment('postal or zipcode');
          $table->string('city')->nullable();
          $table->string('country')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->default('mail@example.com');
          $table->string('url')->nullable()->comment('Your website domain. With http(s)://');
          $table->string('vat_number')->nullable();
          $table->string('currency')->default('KR')->nullable();
          $table->string('schema_currency')->default('DKK')->nullable();
          $table->string('bambora_api')->default('bamboraApi')->nullable();
          $table->string('bambora_merchant')->default('bamboraMerchant')->nullable();
          $table->string('shipmondo_api')->default('shipmondo')->nullable();
          $table->string('prefix')->nullable();
          $table->string('cookie_msg')->default('This website uses cookies in order to offer you the most relevant information. Please accept cookies for optimal performance')->nullable();
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
        Schema::dropIfExists('mc_shop_informations');
    }
}
