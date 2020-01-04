<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

class MonkCommerceOrderProduct extends Model
{
  protected $table = 'mc_orders_products';
  public $timestamps = false;
}
