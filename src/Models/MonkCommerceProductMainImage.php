<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

class MonkCommerceProductMainImage extends Model
{
  protected $table = 'mc_prod_main_images';
  public $timestamps = false;

  protected $fillable = [
    'product_id',
    'filename',
  ];
}
