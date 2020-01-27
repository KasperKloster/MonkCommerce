@extends('monkcommerce::monkcommerce-storefront.layouts.checkout-main')
  @section('page-title')
    Checkout - Delivery
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop
  @section('stylesheet')
  <link rel="stylesheet" href="{{ URL::asset('monkcommerce/css/storefront/checkout/checkout-style.min.css') }}">
  @stop

@section('left')
<div class="pt-4 mx-5">
  <h3>Checkout</h3>
  @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._checkout-steps', ['step2' => TRUE, 'step3' => FALSE])
  <hr/>

  <form action="{{ route('monk-shop-checkout-post') }}" method="post" id="checkout-form">
    @csrf
    <!-- Billing Adress -->
    <h5 class="mb-3">Delivery Address</h5>
      <!-- Name -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="first_name">First name</label>
          <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
          @error('first_name')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col-md-6 mb-3">
          <label for="last_name">Last name</label>
          <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
          @error('last_name')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <!-- Address -->
      <div class="mb-3">
        <label for="street_address">Address</label>
        <input type="text" class="form-control form-control-sm @error('street_address') is-invalid @enderror" id="street_address" name="street_address" value="{{ old('street_address') }}" required>
        @error('street_address')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <!-- Postal, city -->
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="postal_code">Postal Code</label>
          <input type="text" class="form-control form-control-sm @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
          @error('postal_code')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col-md-5 mb-3">
          <label for="city">City</label>
          <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
          @error('city')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="country">Country</label>
          <select class="d-block w-100 form-control form-control-sm @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" required>
            <option disabled>Choose...</option>
            <option>United States</option>
          </select>
          @error('country')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <hr/>
      <h3>Shipping</h3>

      <hr/>
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
