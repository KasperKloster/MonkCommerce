<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;

class MonkCommerceProductCategory extends Model
{
    // Name of the Table
    protected $table = 'monkcommerce_product_categories';

    // protected $fillable = [
    //     'category_name',
    //     'category_description',
    //     'show_in_menu',
    // ];

    /*
    * Relationships
    */
    public function productCategories()
    {
      return $this->hasMany(MonkCommerceProductCategory::class, 'category_id');
    }

    public function productChildrenCategories()
    {
      return $this->hasMany(MonkCommerceProductCategory::class, 'category_id')->with('productCategories');
    }
}
