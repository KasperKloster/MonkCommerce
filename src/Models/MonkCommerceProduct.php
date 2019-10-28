<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;

class MonkCommerceProduct extends Model
{
  // Name of the Table
  protected $table = 'monkcommerce_products';

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
    return $this->belongsToMany(MonkCommerceProductCategory::class, 'monkcommerce_category_product', 'product_id', 'category_id');

    //public BelongsToMany belongsToMany(
    // string $related,
    // string $table = null,
    // string $foreignKey = null,
    // string $otherKey = null,
    // string $relation = null)
  }
}
