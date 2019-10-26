@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-create')

  @section('header')
    {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }}
  @stop

  @section('form')
  <form action="{{ route('monk-admin-store-product') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="productName">{{ ucwords(__('monkcommerce-dashboard.products.product_name')) }}</label>
      <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" required>
    </div>

    <div class="form-group row">
      <div class="col">
        <label for="productSku">SKU</label>
        <input type="text" class="form-control" id="productSku" name="productSku" required>
      </div>
      <div class="col">
        <label for="productQty">{{ ucwords(__('monkcommerce-dashboard.products.quantity')) }}</label>
        <input type="text" class="form-control" id="productQty" name="productQty" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col">
        <label for="productPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.price')) }}</label>
        <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="249" required>
      </div>
      <div class="col">
        <label for="productSpecialPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.special_price')) }}</label>
        <input type="text" class="form-control" id="productSpecialPrice" name="productSpecialPrice" placeholder="199" required>
      </div>
    </div>

    <div class="form-group">
      <label for="productDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
      <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
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
  @stop
