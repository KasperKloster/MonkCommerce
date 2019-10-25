@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.products.edit_product')) }} | Admin Dashboard
  @stop

  @section('content')
  <!-- breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page">
        <a class="mat-inline-center text-decoration-none" href="{{ URL::previous() }}"><i class="material-icons">keyboard_backspace</i> {{ ucwords(__('monkcommerce-dashboard.general-words.back')) }}</a>
      </li>
    </ol>
  </nav>

  <!-- Header -->
  <h1>{{ ucwords(__('monkcommerce-dashboard.products.edit_product')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

  <!-- Page Content -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <form action="{{ route('monk-admin-update-product', $product->id) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="productName">{{ ucwords(__('monkcommerce-dashboard.products.product_name')) }}</label>
              <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name }}" required>
            </div>

            <div class="form-group row">
              <div class="col">
                <label for="productSku">SKU</label>
                <input type="text" class="form-control" id="productSku" name="productSku" value="{{ $product->sku }}" required>
              </div>
              <div class="col">
                <label for="productQty">{{ ucwords(__('monkcommerce-dashboard.products.quantity')) }}</label>
                <input type="text" class="form-control" id="productQty" name="productQty" value="{{ $product->qty }}" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col">
                <label for="productPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.price')) }}</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $product->price }}" required>
              </div>
              <div class="col">
                <label for="productSpecialPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.special_price')) }}</label>
                <input type="text" class="form-control" id="productSpecialPrice" name="productSpecialPrice" value="{{ $product->special_price }}" required>
              </div>
            </div>

            <div class="form-group">
              <label for="productDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
              <textarea class="form-control" id="productDescription" name="productDescription" rows="3">{{ $product->description }}</textarea>
            </div>

            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="productInStock" id="productInStock">
              <label class="form-check-label" for="productInStock">{{ ucwords(__('monkcommerce-dashboard.general-words.in_stock')) }}</label>
            </div>

            <div class="form-group row pt-3">
              <div class="col">
                <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.products.create_product')) }}</button>
                <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  @stop
