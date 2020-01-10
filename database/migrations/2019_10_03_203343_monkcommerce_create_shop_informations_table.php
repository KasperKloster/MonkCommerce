<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonkCommerceCreateShopInformationsTable extends Migration
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
          $table->string('shop_name')->nullable();
          $table->string('street_address')->nullable()->comment('eg: 1901 Lemur Ave');
          $table->string('postal_code')->nullable()->comment('postal or zipcode');
          $table->string('city')->nullable();
          $table->string('country')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->default('mail@example.com');
          $table->string('url')->nullable()->comment('Your website domain. With http(s)://');
          $table->string('vat_number')->nullable();
          $table->string('shopCurrency')->default('KR')->nullable();
          $table->string('stripe_publishable_key')->nullable();
          $table->string('shopSchemaCurrency')->default('DKK')->nullable();
          $table->string('shopPrefix')->nullable();
          $table->string('cookie_msg')->default('This website uses cookies in order to offer you the most relevant information. Please accept cookies for optimal performance')->nullable();
          $table->timestamps();
      });

      // Insert init. row
      DB::table('mc_shop_informations')->insert(
        array(
         'shop_name' => config('app.name'),
         'url'       => config('app.url')
        )
      );

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
