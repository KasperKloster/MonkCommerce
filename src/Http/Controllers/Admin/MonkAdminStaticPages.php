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
    public function index()
    {
      $staticPages = MonkCommerceStaticPages::paginate(10);

      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.index')->with('staticPages', $staticPages);
    }

    public function create()
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.create');
    }

    public function store(Request $request)
    {
      /* Create Pages */
      $staticPage = MonkCommerceStaticPages::create($this->validateRequest(null));

      // Slug
      $pageSlug = MonkCommerceStaticPages::find($staticPage->id);
      $pageSlug->slug = Str::slug($request->name);
      $pageSlug->update();

      /* Message and Redirect */
      Session::flash('success', 'Page Has Been Created');
      return Redirect::route('static-page.index');
    }

    public function edit(MonkCommerceStaticPages $staticPage)
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.static_pages.edit', compact('staticPage'));
    }

    public function update(Request $request, MonkCommerceStaticPages $staticPage)
    {
      /* Update Pages */
      $staticPage->update($this->validateRequest($staticPage->id));
      // Slug
      $pageSlug = MonkCommerceStaticPages::find($staticPage->id);
      $pageSlug->slug = Str::slug($request->name);
      $pageSlug->update();

      /* Message and Redirect */
      Session::flash('success', 'Page Has Been Updated');
      return Redirect::route('static-page.index');
    }

    public function destroy(MonkCommerceStaticPages $staticPage)
    {
      $staticPage->delete();

      /* Message and Redirect */
      Session::flash('success', 'Page Has Been Deleted');
      return Redirect::route('static-page.index');
    }

    private function validateRequest($id)
    {
      return request()->validate([
        'name'            => 'required|string|max:150|unique:mc_static_pages,name,' . $id,
        'description'     => 'required|string',
        'show_in_menu'    => 'nullable|boolean',
      ]);
    }
}
