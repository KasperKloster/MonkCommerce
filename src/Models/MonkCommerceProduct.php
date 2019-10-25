<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

class MonkCommerceProduct extends Model
{
  // Name of the Table
  protected $table = 'monkcommerce_products';

  protected $fillable = [
      'sku',
      'name',
      'slug',
      'description',
      'price',
      'special_price',
      'qty',
      'in_stock',
  ];
}
