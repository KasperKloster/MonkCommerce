<?php

namespace KasperKloster\MonkCommerce\Repositories\Dashboard;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductImage;

use Str;


class UpdateProduct
{
  public function syncAttributes($categories, $attributes, $product)
  {
    // If attribute is NULL, then it's select. Remove from Array
    foreach($attributes as $key => $value)
    {
      if ($value == 'NULL')
      {
        unset($attributes[$key]);
      }
    }
    // Sync attributes
    $product->attributeValues()->sync($attributes);

    // Sync Product to Categorie(s)
    $product->productCategories()->sync($categories);
  }

  public function updateImages($request, $product)
  {
    /*
    * Images
    */
    $image_path = public_path().'/monkcommerce/images/products/';
    // Original Images
    // All Original Images Arr
    $allOrgImages = $request->orgImages;
    // Deleted images are not in this array
    $keepImages = $request->delOrgImages;
    // If keeps are empty Delete All
    if ($keepImages == NULL)
    {
      $dbImage = MonkCommerceProductImage::select('id', 'filename')->where('product_id', $product->id)->get()->toArray();
      foreach($dbImage as $key => $value)
      {
        $dbImg = MonkCommerceProductImage::destroy($value['id']);
        if ($value['filename'] != '/default.jpg')
        {
          // Delete from Folder
          if (File::exists($image_path . $value['filename']))
          {
            File::delete($image_path . $value['filename']);
          }
        }
      }
    }
    // Delete Org. images
    if ($keepImages != NULL)
    {
      $imgDifference = array_diff($allOrgImages, $keepImages);
      foreach($imgDifference as $imageName)
      {
        // Select and Delete from DB
        $dbImage = MonkCommerceProductImage::where('product_id', $product->id)->where('filename', $imageName)->first();
        $dbImg = MonkCommerceProductImage::destroy($dbImage->id);
        // Do not delete default image from Folder
        if ($imageName != '/default.jpg')
        {
          // Delete from Folder
          if (File::exists($image_path . $imageName))
          {
            File::delete($image_path . $imageName);
          }
        }
      }
    }
    // Upload New Images
    if (request()->hasFile('filename'))
    {
      $i = 0;
      foreach($request->file('filename') as $image)
      {
        // ImgName and folder
        $imgExt = $image->getClientOriginalExtension();
        $newImgName = strtolower($request->sku . '-' . Str::snake($request->name) . '-' . $i . '-' . time() . '.' . $imgExt);
        $destinationPath = public_path('/monkcommerce/images/products/' . $product->id . '/');
        $image->move($destinationPath, $newImgName);
        // Create to DB
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = $product->id . '/' . $newImgName;
        $imageModel->save();
        //
        $i++;
      }
    }
    // Check if has main_img is set. Othervise take a random. if all empty. take def.
    if (request()->filled('mainImg') == FALSE)
    {
      $dbImgs = MonkCommerceProductImage::select('id', 'filename', 'main')->where('product_id', $product->id)->first();
      // If empty, there is no images, set a default
      if(empty($dbImgs))
      {
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = '/default.jpg';
        $imageModel->main = TRUE;
        $imageModel->save();
      }
      else
      {
        // Else let the first be main
        $dbImgs->main = TRUE;
        $dbImgs->update();
      }
    }
  }
}
