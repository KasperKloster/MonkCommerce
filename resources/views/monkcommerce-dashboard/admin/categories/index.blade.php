@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.categories.all_categories')) }}| Admin Dashboard
  @stop

@section('content')
  <h1>{{ ucwords(__('monkcommerce-dashboard.categories.all_categories')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

  <!-- Page Content -->
  <div class="row">
    <div class="col-md-12">
      <!-- Table Header -->
      <div class="card">
        <div class="card-header">
          <div class="nav justify-content-end">
            <a href="{{ route('monk-admin-create-category') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }}</a>
          </div>
        </div>

        <!-- Categories Table -->
        @foreach ($productCategories as $productCategory)
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header bg-white" id="headingOne">
              <!-- Header -->
              <div class="d-flex justify-content-start">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$productCategory->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{ $productCategory->name }}
                  </button>
                </h2>
              </div>
              <!-- Buttons -->
              <div class="d-flex justify-content-end">
                <!-- edit -->
                <a href="{{ route('monk-admin-edit-category', $productCategory->id) }}" class="btn btn-sm btn-info mat-inline-center">
                  <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
                </a>
                <!-- create subcategory -->
                <a href="{{ route('monk-admin-create-subcategory', $productCategory->id)}}" class="btn btn-sm btn-success mat-inline-center ml-3">
                  <i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}
                </a>
                <!-- show in shop -->
                <a href="{{ route('monk-shop-single-category', $productCategory->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
                  {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
                </a>
                <!-- Delete Category -->
                <a href="{{ route('monk-admin-create-subcategory', $productCategory->id)}}" class="btn btn-sm btn-danger mat-inline-center">
                  <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
                </a>
              </div>
            </div>

            <!-- accordion Content / Subcategories -->
            <div id="collapse{{$productCategory->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <table class="card-table table table-sm table-hover bg-light mt-3">
                <tbody>
                  @foreach($productSubCategories as $productSubcategory)
                    @if($productCategory->id == $productSubcategory->product_category_id)
                      <tr class="pt-5">
                        <td class="pl-5"><i class="material-icons">subdirectory_arrow_right</i></td>
                        <td>{{ $productSubcategory->name }}</td>
                        <td class="d-flex justify-content-end">
                          <!-- edit -->
                          <a href="{{ route('monk-admin-edit-subcategory', $productSubcategory->id) }}" class="btn btn-sm btn-info mat-inline-center">
                            <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
                          </a>
                          <!-- show in shop -->
                          <a href="{{ route('monk-shop-single-category', $productSubcategory->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
                            {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
                          </a>
                          <!-- Delete Category -->
                          <a href="" class="btn btn-sm btn-danger mat-inline-center">
                            <i class="material-icons">delete_forever</i> Delete
                          </a>
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div> <!-- /.card -->
        </div> <!-- /.accordion -->
        @endforeach

      </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
  </div> <!-- /. row -->

  <!-- Pagination -->
  <div class="row pt-3">
    <div class="col-md-12">
      <div class="d-flex justify-content-center">
        {{ $productCategories->links() }}
      </div>
    </div>
  </div>

@stop
