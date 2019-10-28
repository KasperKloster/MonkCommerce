@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.products.all_products')) }} | Admin Dashboard
  @stop

@section('content')
  <h1>{{ ucwords(__('monkcommerce-dashboard.products.all_products')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

  <!-- Page Content -->
  <div class="row">
    <div class="col-md-12">
      <!-- Table Header -->
      <div class="card">
        <div class="card-header">
          <div class="nav justify-content-end">
            <a href="{{ route('monk-admin-create-product') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }}</a>
          </div>
        </div>
        <!-- Table List -->
        <table class="card-table table table-hover table-responsive-lg">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">SKU</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Special Price</th>
              <th scope="col">Quantity</th>
              <th>Buttons</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->special_price }}</td>
                <td>{{ $product->qty }}</td>
                <td>
                  <!-- edit -->
                  <a href="{{ route('monk-admin-edit-product', $product->id) }}" class="btn btn-sm btn-info mat-inline-center">
                    <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
                  </a>
                  <!-- show in shop -->
                  <a href="{{ route('monk-shop-single-product', $product->slug)}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
                    {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
                  </a>
                  <!-- Delete Category -->
                  <a href="{{ route('monk-admin-destroy-product', $product->id) }}" class="btn btn-sm btn-danger mat-inline-center">
                    <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
                  </a>

                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
  </div> <!-- /. row -->

  <!-- Pagination -->
  <div class="row pt-3">
    <div class="col-md-12">
      <div class="d-flex justify-content-center">
        {{ $products->links() }}
      </div>
    </div>
  </div>

@stop
