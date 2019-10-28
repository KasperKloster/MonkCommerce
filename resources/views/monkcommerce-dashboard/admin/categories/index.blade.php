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

        <ul>
        @foreach ($productCategories as $category)
          <li>{{ $category->name }}</li>
              <!-- edit -->
              <a href="{{ route('monk-admin-edit-category', $category->id) }}" class="btn btn-sm btn-info mat-inline-center">
                <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
              </a>
              <!-- create subcategory -->
              <a href="{{ route('monk-admin-create-category', ['parentCat' => $category->id])}}" class="btn btn-sm btn-success mat-inline-center ml-3">
                <i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}
              </a>
              <!-- show in shop -->
              <a href="{{ route('monk-shop-single-category', $category->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
                {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
              </a>
              <!-- Delete Category -->
              <a href="{{ route('monk-admin-destroy-category', $category->id) }}" class="btn btn-sm btn-danger mat-inline-center">
                <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
              </a>
            <ul>
            @foreach ($category->productChildrenCategories as $childCategory)
                @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
            @endforeach
            </ul>
        @endforeach
        </ul>

        {{-- @foreach ($productCategories as $category)
        <div class="accordion" id="accordion{{ $category->name }}">
          <div class="card">
            <div class="card-header" id="heading{{ $category->name }}">
              <!-- Header -->
              <div class="d-flex justify-content-start">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $category->name }}" aria-expanded="true" aria-controls="collapse{{ $category->name }}">
                    {{ $category->name }}
                  </button>
                </h2>
              </div>

              <!-- Buttons -->
              <div class="d-flex justify-content-end">
                <!-- edit -->
                <a href="{{ route('monk-admin-edit-category', $category->id) }}" class="btn btn-sm btn-info mat-inline-center">
                  <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
                </a>
                <!-- create subcategory -->
                <a href="{{ route('monk-admin-create-category', ['parentCat' => $category->id] )}}" class="btn btn-sm btn-success mat-inline-center ml-3">
                  <i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}
                </a>
                <!-- show in shop -->
                <a href="{{ route('monk-shop-single-category', $category->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
                  {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
                </a>
                <!-- Delete Category -->
                <a href="#" class="btn btn-sm btn-danger mat-inline-center">
                  <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
                </a>
              </div>
            </div> <!-- /.card-header -->
          </div> <!-- /.card -->

          <!-- accordion Content / Subcategories -->
          <div id="collapse{{ $category->name }}" class="collapse" aria-labelledby="heading{{ $category->name }}" data-parent="#accordion{{ $category->name }}">
            @foreach ($category->productChildrenCategories as $childCategory)
                @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
            @endforeach
          </div>
        </div> <!-- /.accordion -->
        @endforeach --}}

      </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
  </div> <!-- /. row -->

  <!-- Pagination -->
  {{-- <div class="row pt-3">
    <div class="col-md-12">
      <div class="d-flex justify-content-center">
        {{ $productCategories->links() }}
      </div>
    </div>
  </div> --}}

@stop
