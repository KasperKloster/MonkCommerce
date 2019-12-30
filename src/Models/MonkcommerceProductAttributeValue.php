<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;

class MonkCommerceProductAttributeValue extends Model
{
  // Name of the Table
  protected $table = 'mc_prod_attr_values';
  public $timestamps = false;

  /*
  * Relationships
  */
  public function attributes()
  {
    //return $this->hasMany(MonkCommerceProductAttribute::class, 'mc_prod_attr_prod_values');
    return $this->belongsToMany(MonkCommerceProductAttribute::class, 'mc_prod_attr_prod_values', 'product_attribute_value_id', 'product_attribute_id');
  }

  public function products()
  {
    return $this->hasMany(MonkCommerceProduct::class, 'mc_prod_attr_value_prod');
  }
}
