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
      Schema::create('monkcommerce_shop_informations', function (Blueprint $table) {
          $table->increments('id');
          $table->string('shop_name')->nullable();
          $table->string('street_address')->nullable()->comment('eg: 1901 Lemur Ave');
          $table->string('postal_code')->nullable()->comment('postal or zipcode');
          $table->string('city')->nullable();
          $table->string('country')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->nullable();
          $table->string('url')->nullable()->comment('Your website domain. Use with http(s):// and www. ');
          $table->string('vat_number')->nullable()->comment('Your website domain. Use with http(s):// and www. ');
          $table->timestamps();
      });

      // Insert some stuff
      DB::table('monkcommerce_shop_informations')->insert(
        array(
         'shop_name' => 'monkcommerce Demoshop'
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
        Schema::dropIfExists('monkcommerce_shop_informations');
    }
}
