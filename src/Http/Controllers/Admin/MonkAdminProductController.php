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
          $imageModel->filename   = $newImgName;
          if($i == 0)
          {
            $imageModel->main_image = TRUE;
          }
          $imageModel->save();

          $i++;
        }
      }

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Created');
      return Redirect::route('monk-admin-products-home');
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
      //$product = MonkCommerceProduct::where('id', $id)->with('images')->get();
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
      // Compare and Find deleted images (Existing)
      if (request()->has('orgImages'))
      {
        $dbImgs = MonkCommerceProductImage::select('id', 'filename')->where('product_id', $id)->get()->toArray();
        //convert $dbImgs to indexed array
        foreach ($dbImgs as $key => $value)
        {
          $dbImgArr[$value['id']] = $value['filename'];
        }
        // Find Difference between DB array and request array
        $imgDifference = array_diff($dbImgArr, $request->orgImages);
        // Delete diffences from from public_folder and DB
        $image_path = public_path().'/monkcommerce/images/products/' . $id . '/';
        foreach ($imgDifference as $id => $imgName)
        {
          if (File::exists($image_path . $imgName))
          {
            // Folder
            File::delete($image_path . $imgName);
            // DB
            $dbImg = MonkCommerceProductImage::find($id);
            $dbImg->destroy($id);
          }
        }
        // Main Image
        // Set old Main Image as NULL
        $oldMainImg = MonkCommerceProductImage::where('main_image', TRUE)->where('product_id', $id)->first();
        $oldMainImg->update(['main_image' => FALSE]);
        // Set Main Image
        $newMainImg = MonkCommerceProductImage::findOrFail($request->mainImg);
        $newMainImg->update(['main_image' => TRUE]);
      }

      // New uploaded images
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
          $imageModel->filename   = $newImgName;
          if($i == 0)
          {
            $imageModel->main_image = TRUE;
          }
          $imageModel->save();

          $i++;
        }
      }

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Updated');
      return Redirect::route('monk-admin-products-home');

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
        if (File::exists($image_path))
        {
           File::deleteDirectory($image_path);
        }
        // Delete from DB
        $image->destroy($image->id);
      }

      // Finally Delete the product
      $product->destroy($id);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Deleted');
      return Redirect::route('monk-admin-products-home');
    }
}
