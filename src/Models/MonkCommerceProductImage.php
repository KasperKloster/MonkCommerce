<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;

class MonkCommerceProductImage extends Model
{
    protected $table = 'mc_prod_images';

    protected $fillable = [
        'product_id',
        'filename',
        'main_image',
    ];

    /*
    * Relationships
    */
    //
    // public function products()
    // {
    //   return $this->belongsTo(MonkCommerceProduct::class);
    //   //, 'mc_prod_images', 'product_id', 'id'
    // }
}
