<?php

namespace KasperKloster\MonkCommerce\Models;
// Models
use Illuminate\Database\Eloquent\Model;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

class MonkCommerceOrderStatus extends Model
{
    protected $table = 'mc_orders_status';
    public $timestamps = false;

    /*
    * Relationships
    */
    // public function orders()
    // {
    //   return $this->belongsToMany(MonkCommerceOrderStatus::class, 'mc_orders_orders_status', 'order_status_id', 'order_id');
    // }
}
