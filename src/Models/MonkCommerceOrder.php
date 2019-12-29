<?php

namespace KasperKloster\MonkCommerce\Models;
use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;

class MonkCommerceOrder extends Model
{
  protected $table = 'mc_orders';

  /*
  * Relationships
  */

  public function customer()
  {
    //return $this->belongsToMany(MonkCommerceProductCategory::class, 'mc_category_product', 'product_id', 'category_id');

    return $this->hasOne(MonkCommerceOrderCustomer::class, 'order_id');
  }



}
