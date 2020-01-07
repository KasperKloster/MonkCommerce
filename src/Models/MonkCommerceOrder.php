<?php

namespace KasperKloster\MonkCommerce\Models;
use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;
use KasperKloster\MonkCommerce\Models\MonkCommerOrderCustomerDelivery;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderStatus;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;


class MonkCommerceOrder extends Model
{
  protected $table = 'mc_orders';
  protected $primaryKey = 'id';

  /*
  * Relationships
  */
  public function orderCustomer()
  {
    return $this->belongsTo(MonkCommerceOrderCustomer::class, 'order_customer_id');
  }

  public function orderCustomerDelivery()
  {
    return $this->belongsTo(MonkCommerOrderCustomerDelivery::class, 'order_customer_delivery_id');
  }
  //
  public function orderStatus()
  {
    return $this->belongsTo(MonkCommerceOrderStatus::class);
  }
  //
  public function orderProduct()
  {
    return $this->belongsToMany(MonkCommerceProduct::class, 'mc_orders_products', 'order_id', 'product_id')->withPivot('qty');
  }

}
