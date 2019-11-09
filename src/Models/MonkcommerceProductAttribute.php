<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;


class MonkCommerceProductAttribute extends Model
{
  // Name of the Table
  protected $table = 'mc_prod_attr';

  public $timestamps = false;

  /*
  * Relationships
  */
  public function attributeValues()
  {
    return $this->belongsToMany(MonkCommerceProductAttributeValue::class, 'mc_prod_attr_prod_values', 'product_attribute_id', 'product_attribute_value_id');
  }

  // public function products()
  // {
  //   return $this->hasManyThrough(MonkCommerceProduct::class, MonkCommerceProductAttributeValue::class);
  // }
}
