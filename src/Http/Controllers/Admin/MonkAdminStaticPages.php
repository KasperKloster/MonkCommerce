<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
Use Redirect;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;


class MonkAdminStaticPages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pages = MonkCommerceStaticPages::paginate(10);

      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.index')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Validation
      $request->validate([
        'pageName'        => 'required|string|max:150|unique:mc_static_pages,name',
        'pageDescription' => 'required|string',
        'showInMenu'      => 'nullable',
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
      * Create Pages
      */
      $category = new MonkCommerceStaticPages;
      $category->name         = $request->pageName;
      $category->slug         = Str::slug($request->pageName);
      $category->description  = $request->pageDescription;
      $category->show_in_menu = $request->showInMenu;
      $category->save();

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Page Has Been Created');
      return Redirect::route('monk-admin-pages-index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $page = MonkCommerceStaticPages::find($id);
      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.edit')->with('page', $page);

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
      // Validation
      $request->validate([
        'pageName'        => 'required|string|max:150|unique:mc_static_pages,name',
        'pageDescription' => 'required|string',
        'showInMenu'      => 'nullable',
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
      * Create Pages
      */
      $category = new MonkCommerceStaticPages;
      $category->name         = $request->pageName;
      $category->slug         = Str::slug($request->pageName);
      $category->description  = $request->pageDescription;
      $category->show_in_menu = $request->showInMenu;
      $category->update();

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Page Has Been Updated');
      return Redirect::route('monk-admin-pages-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $page = MonkCommerceStaticPages::find($id);
      $page->delete();
      /*
      * Message and Redirect
      */
      Session::flash('success', 'Page Has Been Deleted');
      return Redirect::route('monk-admin-pages-index');
    }
}
