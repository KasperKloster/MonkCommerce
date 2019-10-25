<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;

use Illuminate\Http\Request;

use Redirect;
use Str;
use Session;

class MonkAdminProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subs = MonkCommerceProductSubcategory::all();

      return view('monkcommerce::monkcommerce-dashboard.admin.categories.subcategories.index')
      ->with('subs', $subs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mainCategory)
    {
      // Parent Category from route
      $mainCategory = MonkCommerceProductcategory::where('id', $mainCategory)->first();

      return view('monkcommerce::monkcommerce-dashboard.admin.categories.subcategories.create')
              ->with('mainCategory', $mainCategory);
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
        'mainCategoryValue'        => 'required|integer|min:1',
        'subcategoryName'          => 'required|min:1|max:40|unique:monkcommerce_product_subcategories,name',
        'subcategoryDescription'   => 'nullable|max:1000',
        'showInMenu'               => 'nullable|max:2',
      ]);

      /*
      * Create Subcategory
      */
      $subcategory = new MonkCommerceProductSubcategory;

      $subcategory->name                = $request->subcategoryName;
      $subcategory->slug                = Str::slug($request->subcategoryName);
      $subcategory->description         = $request->subcategoryDescription;
      $subcategory->product_category_id = $request->mainCategoryValue;
      $subcategory->show_in_menu        = $request->showInMenu;

      $subcategory->save();

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Subcategory Has Been Created');
      return Redirect::route('monk-admin-categories-home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MonkCommerceProductSubcategory  $monkCommerceProductSubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($monkCommerceProductSubcategory)
    {
      // Find Category
      $subcategory = MonkCommerceProductSubcategory::find($monkCommerceProductSubcategory);
      // Main Categories
      $mainCategories = MonkCommerceProductcategory::all();
      // Return View
      return view('monkcommerce::monkcommerce-dashboard.admin.categories.subcategories.edit')
              ->with('subcategory', $subcategory)
              ->with('mainCategories', $mainCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MonkCommerceProductSubcategory  $monkCommerceProductSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $monkCommerceProductSubcategory)
    {
        /*
        * Validate
        */
        $request->validate([
          'mainCategoryValue'        => 'required|integer|min:1',
          'subcategoryName'          => 'required|min:1|max:40|unique:monkcommerce_product_subcategories,name,' . $request->id,
          'subcategoryDescription'   => 'nullable|max:1000',
          'showInMenu'               => 'nullable|max:2',
        ]);

        // Getting Checkbox
        if($request->showInMenu == 'on')
        {
          $request->showInMenu = 1;
        }
        else
        {
          $request->showInMenu = NULL;
        }

        /*
        * Update
        */
        $subcategory = MonkCommerceProductSubcategory::find($monkCommerceProductSubcategory);
        $subcategory->name                = $request->subcategoryName;
        $subcategory->slug                = Str::slug($request->subcategoryName);
        $subcategory->description         = $request->subcategoryDescription;
        $subcategory->product_category_id = $request->mainCategoryValue;
        $subcategory->show_in_menu        = $request->showInMenu;
        $subcategory->save();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Subcategory Has Been Updated');
        return Redirect::route('monk-admin-categories-home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MonkCommerceProductSubcategory  $monkCommerceProductSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonkCommerceProductSubcategory $monkCommerceProductSubcategory)
    {
        //
    }
}
