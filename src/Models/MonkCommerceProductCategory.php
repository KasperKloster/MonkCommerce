<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;

class MonkCommerceProductCategory extends Model
{
    // Name of the Table
    protected $table = 'mc_product_categories';

    // protected $fillable = [
    //     'category_name',
    //     'category_description',
    //     'show_in_menu',
    // ];

    /*
    * Relationships
    */
    // Categories and recursive subcategories
    public function productCategories()
    {
      return $this->hasMany(MonkCommerceProductCategory::class, 'category_id');
    }

    public function productChildrenCategories()
    {
      return $this->hasMany(MonkCommerceProductCategory::class, 'category_id')->with('productCategories');
    }

    // Products
    public function products()
    {
      return $this->belongsToMany(MonkCommerceProduct::class, 'mc_category_product', 'category_id', 'product_id');
    }

    //public BelongsToMany belongsToMany(
    // string $related,
    // string $table = null,
    // string $foreignKey = null,
    // string $otherKey = null,
    // string $relation = null)
}
