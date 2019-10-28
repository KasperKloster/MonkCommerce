<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

// Models
use KasperKloster\MonkCommerce\Models\MonkcommerceProductAttributeValue;

class MonkcommerceProductAttribute extends Model
{
  // Name of the Table
  protected $table = 'monkcommerce_product_attributes';

  /**
  * @var array
  */
  protected $fillable = [
    // 'code',
    'name',
    // 'frontend_type',
    // 'is_filterable',
    // 'is_required'
  ];

  // /**
  // * @var array
  // */
  // protected $casts  = [
  //   'is_filterable' =>  'boolean',
  //   'is_required'   =>  'boolean',
  // ];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function productAttributeValues()
  {
    return $this->hasMany(MonkcommerceProductAttributeValue::class, 'id');
  }

}
