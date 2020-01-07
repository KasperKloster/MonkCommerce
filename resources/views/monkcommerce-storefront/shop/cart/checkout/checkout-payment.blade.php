@extends('monkcommerce::monkcommerce-storefront.layouts.checkout-main')
  @section('page-title')
    Checkout - Payment
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
  @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._checkout-steps', ['step2' => TRUE, 'step3' => TRUE])
  <hr/>

  <form action="{{ route('monk-shop-checkout-payment-post') }}" method="post" id="checkout-form">
    @csrf
    <!-- Payment Adress -->
    <h5 class="mb-3">Payment</h5>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="cc-name">Name on card</label>
          <input type="text" class="form-control form-control-sm @error('cc-name') is-invalid @enderror" id="cc-name" name="cc-name" required>
          <small class="text-muted">Full name as displayed on card</small>
          @error('cc-name')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="cc-number">Credit card number</label>
          <input type="text" class="form-control form-control-sm @error('cc-number') is-invalid @enderror" id="cc-number" name="cc-number" required>
          @error('cc-number')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cc-expiration">Expiration</label>
          <input type="text" class="form-control form-control-sm @error('cc-expiration') is-invalid @enderror" id="cc-expiration" name="cc-expiration" required>
          @error('cc-expiration')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col-md-6 mb-3">
          <label for="cc-cvv">CVV</label>
          <input type="text" class="form-control form-control-sm @error('cc-cvv') is-invalid @enderror" id="cc-cvv" name="cc-cvv" required>
          @error('cc-cvv')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <hr/>
      <!-- Buttons -->
      <div class="row d-flex justify-content-between">
        <div class="col-md-4">
          <a href="{{ route('monk-shop-cart-index') }}"><small>< Return to cart</small></a>
        </div>
        <div class="col-md-4">
          <button class="btn btn-success btn-md btn-block" type="submit">Place Your Order</button>
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
