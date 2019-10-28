<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkcommerceProductAttribute;

class MonkcommerceProductAttributeValue extends Model
{
  // Name of the Table
  protected $table = 'monkcommerce_product_attribute_values';

  /**
  * @var array
  */
  protected $fillable = [
      'attribute_id',
      'value',
      'price'
  ];

  /**
  * @var array
  */
  protected $casts = [
    'attribute_id'  =>  'integer',
  ];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
  public function productAttribute()
  {
    return $this->belongsTo(MonkcommerceProductAttribute::class, 'id', 'attribute_id');
  }

}
