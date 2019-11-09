<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;

class MonkAdminProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $attrs = MonkCommerceProductAttribute::with('attributeValues')->paginate(10);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.attributes.index')->with('attrs', $attrs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.products.attributes.create');
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
        'attrName'      => 'required|string|max:255|unique:mc_prod_attr,name',
        'attrValueName' => 'nullable|array|unique:mc_prod_attr_values,value',
      ]);

      // Store Attribute
      $attribute = new MonkCommerceProductAttribute;
      $attribute->name = $request->attrName;
      $attribute->slug = Str::slug($request->attrName);
      $attribute->save();

      // Store Values
      if ($request->attrValueName != NULL)
      {
        $storeArr = [];
        for ($i = 0; $i < count($request->attrValueName); $i++)
        {
          array_push($storeArr, ['value' => $request->attrValueName[$i]]);
        }
        MonkCommerceProductAttributeValue::insert($storeArr);

        // Store Pivot
        foreach($storeArr as $store)
        {
          $storVal = $store['value'];
          $valId = MonkCommerceProductAttributeValue::where('value', $storVal)->get();
          $attribute->attributeValues()->attach($valId);
        }
      }
      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Attribute Has Been Created');
      return Redirect::route('monk-admin-products-attr-home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // Find Attribute
      $attr = MonkCommerceProductAttribute::with('attributeValues')->find($id);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.attributes.edit')->with('attr', $attr);
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
        'attrName'      => 'required|string|max:255',
        'attrValueName' => 'nullable|array',
        'newAttrValue'  => 'nullable|array',
      ]);

      /*
      * Update Attribute
      */
      // Store Attribute
      $attribute = MonkCommerceProductAttribute::find($id);
      $attribute->name = $request->attrName;
      $attribute->slug = Str::slug($request->attrName);
      $attribute->update();

      // Store Values
      // Old and Existing AttrValue
      $oldAttrValue = $request->oldAttrValueId;
      $newAttrValue = $request->exValueId;
      if ($newAttrValue != NULL)
      {
        // Compare old and Existing
        $deleteValues = array_diff($oldAttrValue, $newAttrValue);
        // Delete differences
        foreach($deleteValues as $id)
        {
          $attrValue = MonkCommerceProductAttributeValue::find($id);
          $attrValue->destroy($id);
        }

        // Update existing attribute values
        foreach ($request->attrValueId as $key => $value)
        {
          // id = $key
          $attrValue = MonkCommerceProductAttributeValue::find($key);
          // value = $value
          $attrValue->value = $value;
          $attrValue->update();
        }
      }

      // Insert Newly added Values (If any has been added)
      if ($request->newAttrValue != NULL)
      {
        $storeArr = [];
        for ($i = 0; $i < count($request->newAttrValue); $i++)
        {
          array_push($storeArr, ['value' => $request->newAttrValue[$i]]);
        }
        MonkCommerceProductAttributeValue::insert($storeArr);

        // Store in Pivot
        foreach($storeArr as $store)
        {
          $storVal = $store['value'];
          $valId = MonkCommerceProductAttributeValue::where('value', $storVal)->get();
          $attribute->attributeValues()->attach($valId);
        }
      }

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Attribute Has Been Updated');
      return Redirect::route('monk-admin-products-attr-home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Find attribute
      $productAttr = MonkCommerceProductAttribute::find($id);
      // Delete Attribute Value
      foreach($productAttr->attributeValues as $value)
      {
        $attrVal = MonkCommerceProductAttributeValue::find($value->id);
        $attrVal->delete();
      }
      // Detach attribute and values
      $productAttr->attributeValues()->detach();
      // Delete product attribute
      $productAttr->delete();
      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Attribute Has Been Deleted');
      return Redirect::route('monk-admin-products-attr-home');
    }
}
