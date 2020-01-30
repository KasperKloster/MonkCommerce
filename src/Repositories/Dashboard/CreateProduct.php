<?php

namespace KasperKloster\MonkCommerce\Repositories\Dashboard;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductImage;
use Str;

class CreateProduct
{
  public function attachAttributes($categories, $attributes, $product)
  {
    // If attribute is NULL, then it's select. Remove from Array
    foreach($attributes as $key => $value)
    {
      if ($value == 'NULL')
      {
        unset($attributes[$key]);
      }
    }
    // Attach Product to Categorie(s)
    $productCategory = MonkCommerceProductCategory::find($categories);
    $product->productCategories()->attach($productCategory);

    // Attach Product Attributes
    $attrValue = MonkCommerceProductAttributeValue::find($attributes);
    $product->attributeValues()->attach($attrValue);
  }

  public function setImages($filenames, $product)
  {
    // Loop through all images
    $i = 0;
    foreach($filenames as $image)
    {
      // ImgName and folder
      $imgExt = $image->getClientOriginalExtension();
      $newImgName = strtolower($product->sku . '-' . Str::snake($product->name) . '-' . $i . '-' . time() . '.' . $imgExt);
      $destinationPath = public_path('/monkcommerce/images/products/' . $product->id . '/');
      $image->move($destinationPath, $newImgName);

      // Create to DB
      $imageModel = new MonkCommerceProductImage;
      $imageModel->product_id = $product->id;
      // If first image, make it as main
      if($i == 0)
      {
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = $product->id . '/' . $newImgName;
        $imageModel->main = '1';
        $imageModel->save();
      }
      // Create all other images
      else
      {
        // Create to DB
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = $product->id . '/' . $newImgName;
        $imageModel->save();
      }
      $i++;
    }

  }
}
