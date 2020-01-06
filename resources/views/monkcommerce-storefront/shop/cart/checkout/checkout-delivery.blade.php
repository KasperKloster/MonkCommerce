@extends('monkcommerce::monkcommerce-storefront.layouts.checkout-main')
  @section('page-title')
    Checkout - Delivery
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop
  @section('stylesheet')
  <link rel="stylesheet" href="{{ URL::asset('monkcommerce/css/storefront/checkout/checkout-style.css') }}">
  @stop

@section('left')
<div class="pt-4 mx-5">
  <h3>Checkout</h3>
  @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._checkout-steps', ['step2' => TRUE])
  <hr/>

  <form action="{{ route('monk-shop-checkout-post') }}" method="post" id="checkout-form">
    @csrf
    <!-- Billing Adress -->
    <h5 class="mb-3">Delivery Address</h5>
      <!-- Name -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="dfirstName">First name</label>
          <input type="text" class="form-control form-control-sm @error('dfirstName') is-invalid @enderror" id="dfirstName" name="dfirstName" value="{{ old('dfirstName') }}" required>
          @error('dfirstName')
            <small class="text-danger">{{ $message }}</small>
          @enderror

        </div>
        <div class="col-md-6 mb-3">
          <label for="dlastName">Last name</label>
          <input type="text" class="form-control form-control-sm @error('dlastName') is-invalid @enderror" id="dlastName" name="dlastName" value="{{ old('dlastName') }}" required>
          @error('dlastName')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <!-- Address -->
      <div class="mb-3">
        <label for="daddress">Address</label>
        <input type="text" class="form-control form-control-sm @error('dstreetAddress') is-invalid @enderror" id="dstreetAddress" name="dstreetAddress" value="{{ old('dstreetAddress') }}" required>
        @error('dstreetAddress')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <!-- Postal, city -->
      <div class="row">
        <div class="col-md-2 mb-3">
          <label for="dpostalCode">Postal Code</label>
          <input type="text" class="form-control form-control-sm @error('dpostalCode') is-invalid @enderror" id="dpostalCode" name="dpostalCode" value="{{ old('dpostalCode') }}" required>
          @error('dpostalCode')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col-md-5 mb-3">
          <label for="dcity">City</label>
          <input type="text" class="form-control form-control-sm @error('dcity') is-invalid @enderror" id="city" name="dcity" value="{{ old('dcity') }}" required>
          @error('dcity')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col-md-5 mb-3">
          <label for="dcountry">Country</label>
          <select class="d-block w-100 form-control form-control-sm @error('dcountry') is-invalid @enderror" id="dcountry" name="dcountry" value="{{ old('dcountry') }}" required>
            <option disabled>Choose...</option>
            <option>United States</option>
          </select>
          @error('dcountry')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <!-- Info -->
      <div class="row">
        <div class="col-md-7 mb-3">
          <label for="demail">Email</label>
          <input type="demail" class="form-control form-control-sm @error('demail') is-invalid @enderror" id="demail" name="demail" value="{{ old('demail') }}" required>
          @error('demail')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <!-- phone -->
        <div class="col-md-5 mb-3">
          <label for="dphone">Phone</label>
          <input type="tel" class="form-control form-control-sm @error('dphone') is-invalid @enderror" id="phone" name="dphone" value="{{ old('dphone') }}" required>
          @error('phone')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <!-- Buttons -->
      <div class="row d-flex justify-content-between">
        <div class="col-md-4">
          <a href="{{ route('monk-shop-cart-index') }}"><small>< Return to cart</small></a>
        </div>
        <div class="col-md-4">
          <button class="btn btn-success btn-md btn-block" type="submit">Continue to Payment</button>
        </div>
      </div>
  </form>
</div>
@stop

@section('right')
<div class="pt-4 ml-3">
  @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._display-cart')
</div>
@stop
