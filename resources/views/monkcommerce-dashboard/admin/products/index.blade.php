@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.products.all_products')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>{{ ucwords(__('monkcommerce-dashboard.products.all_products')) }}</h1>
@stop

@section('card-btn')
<a href="{{ route('products.create') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }}</a>
@stop

@section('card-content')
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
        <td><a href="{{ route('products.edit', $product->id) }}">{{ $product->name }}</a></td>
        <td>{{ showPrice($product->price) }}</td>
        <td>{{ showPrice($product->special_price) }}</td>
        <td>{{ $product->qty }}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <!-- edit -->
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info mat-inline-center">
              <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
            </a>
            <!-- show in shop -->
            <a href="{{ route('monk-shop-single-product', $product->slug)}}" class="btn btn-sm btn-outline-secondary mat-inline-center" target="_blank">
              {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
            </a>
            <!-- Delete Product  -->
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger mat-inline-center">
                <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
              </button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- Pagination -->
<div class="row pt-3">
  <div class="col-md-12">
    <div class="d-flex justify-content-center">
      {{ $products->links() }}
    </div>
  </div>
</div>

@stop
