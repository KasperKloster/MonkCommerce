<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;

class MonkCommerceProduct extends Model
{
  // Name of the Table
  protected $table = 'mc_products';

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

  /*
  * Relationships
  */
  // Product Categories
  public function productCategories()
  {
    return $this->belongsToMany(MonkCommerceProductCategory::class, 'mc_category_product', 'product_id', 'category_id');
  }

  // Attributes Values
  public function attributeValues()
  {
    return $this->belongsToMany(MonkCommerceProductAttributeValue::class, 'mc_prod_attr_value_prod', 'product_id', 'product_attribute_value_id');
  }

  // Attribute
  // public function attribute()
  // {
  //   return $this->hasManyThrough(MonkCommerceProductAttribute::class, MonkCommerceProductAttributeValue::class, 'some', 'id');
  //
  //     //     return $this->hasManyThrough(
  //     //     Post::class,
  //     //     User::class,
  //     //     'country_id', // Foreign key on users table...
  //     //     'user_id', // Foreign key on posts table...
  //     //     'id', // Local key on countries table...
  //     //     'id' // Local key on users table...
  //     // );
  // }


}
