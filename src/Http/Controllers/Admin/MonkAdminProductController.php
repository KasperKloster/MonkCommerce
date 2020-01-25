<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;
use Validator;
use File;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductImage;

class MonkAdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = MonkCommerceProduct::paginate(10);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.index')
              ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.create')
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*
      * Validate
      */
      $request->validate([
        'productName'         => 'required|min:1|max:255|unique:mc_products,name',
        'productSku'          => 'required|unique:mc_products,sku',
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productWeight'       => 'nullable|integer',
        'productDescription'  => 'nullable',
        'productAttr'         => 'nullable|array',
        'productCategories'   => 'required|array',
        'filename.*'          => 'file|image|max:5000',
      ]);

      /*
      * Create/Store Product
      */
      $product = new MonkCommerceProduct;
      $product->sku           = $request->productSku;
      $product->name          = $request->productName;
      $product->slug          = Str::slug($request->productName);
      $product->description   = $request->productDescription;
      $product->price         = $request->productPrice;
      $product->special_price = $request->productSpecialPrice;
      $product->weight        = $request->productWeight;
      $product->qty           = $request->productQty;
      $product->save();

      // Attach attributes
      $attr = $request->productAttr;
      foreach($attr as $key => $value)
      {
        if ($value == 'NULL')
        {
          unset($attr[$key]);
        }
      }

      $attrValue = MonkCommerceProductAttributeValue::find($request->productAttr);
      $product->attributeValues()->attach($attrValue);

      // Attach Product to Categorie(s)
      $productCategory = MonkCommerceProductCategory::find($request->productCategories);
      $product->productCategories()->attach($productCategory);

      // Store Image(s)
      if (request()->hasFile('filename'))
      {
        $i = 0;
        foreach($request->file('filename') as $image)
        {
          // ImgName and folder
          $imgExt = $image->getClientOriginalExtension();
          $newImgName = strtolower($request->productSku . '-' . Str::snake($request->productName) . '-' . $i . '-' . time() . '.' . $imgExt);
          $destinationPath = public_path('/monkcommerce/images/products/' . $product->id . '/');
          $image->move($destinationPath, $newImgName);

          // Create to DB
          $imageModel = new MonkCommerceProductImage;
          $imageModel->product_id = $product->id;
          // If first image, make it as maun
          if($i == 0)
          {
            $imageModel = new MonkCommerceProductImage;
            $imageModel->product_id = $product->id;
            $imageModel->filename   = $product->id . '/' . $newImgName;
            $imageModel->main = '1';
            $imageModel->save();
          }
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
      else
      {
        // If no attached image, set default image
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = '/default.jpg';
        $imageModel->main = '1';
        $imageModel->save();
      }

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Created');
      return Redirect::route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = MonkCommerceProduct::where('id', $id)->with('images')->first();

      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.edit')
              ->with('product', $product)
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      /*
      * Validate
      */
      $request->validate([
        'productName'         => 'required|min:1|max:255|unique:mc_products,name,' . $request->id,
        //'productSku'          => 'required|unique:mc_products,sku,' . $request->productSku,
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productWeight'       => 'nullable|integer',
        'productDescription'  => 'nullable',
        'productAttr'         => 'nullable|array',
        'productCategories'   => 'required|array',
        'filename.*'          => 'file|image|max:5000',
        'orgImages'           => 'array',
      ]);

      /*
      * Update Product
      */
      $product =  MonkCommerceProduct::find($id);
      $product->sku           = $request->productSku;
      $product->name          = $request->productName;
      $product->slug          = Str::slug($request->productName);
      $product->description   = $request->productDescription;
      $product->price         = $request->productPrice;
      $product->special_price = $request->productSpecialPrice;
      $product->weight        = $request->productWeight;
      $product->qty           = $request->productQty;
      $product->update();

      // If attribute is NULL, then it's select. Remove from Array
      $attr = $request->productAttr;
      foreach($attr as $key => $value)
      {
        if ($value == 'NULL')
        {
          unset($attr[$key]);
        }
      }
      // Sync attributes
      //$attrValue = MonkCommerceProductAttributeValue::find($request->productAttr);
      $product->attributeValues()->sync($attr);

      // Sync Product to Categorie(s)
      //$productCategory = MonkCommerceProductCategory::find($request->productCategories);
      $product->productCategories()->sync($request->productCategories);

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
        $dbImage = MonkCommerceProductImage::select('id', 'filename')->where('product_id', $id)->get()->toArray();
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
          $dbImage = MonkCommerceProductImage::where('product_id', $id)->where('filename', $imageName)->first();
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
          $newImgName = strtolower($request->productSku . '-' . Str::snake($request->productName) . '-' . $i . '-' . time() . '.' . $imgExt);
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
        $dbImgs = MonkCommerceProductImage::select('id', 'filename', 'main')->where('product_id', $id)->first();
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

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Updated');
      return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = MonkCommerceProduct::find($id);
      // Detach products from all categories
      $product->productCategories()->detach();
      // Detach attributes
      $product->attributeValues()->detach();
      // Delete Images
      foreach ($product->images as $image)
      {
        // Delete public_folder from Server
        $image_path = public_path().'/monkcommerce/images/products/' . $product->id . '/';
        File::deleteDirectory($image_path);
        // Delete from DB
        $image->destroy($image->id);
      }
      // Finally Delete the product
      $product->destroy($id);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Deleted');
      return Redirect::route('products.index');
    }
}
