@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    Cart
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop

@section('content')
<div class="container mb-5">
  <div class="py-5">
    <h2>Cart</h2>
  </div>

  @if(Session::has('cart'))
    <ul class="list-group">
      @foreach($products as $product)
      <li class="list-group-item d-flex justify-content-between lh-condensed">

        <div>
        <img src="#">
        </div>
        {{-- $product['item']['images'] --}}
        <div>
          <h6 class="my-0"><a href="{{route('monk-shop-single-product', 1)}}">{{ $product['item']['name'] }}</a></h6>
          @for ($i = 0; $i < count($product['item']['attributeValues']); $i++)
            <small class="text-muted">{{ $product['item']['attributeValues'][$i]['value'] }} | </small>
          @endfor
        </div>

        <div>
          @if ($product['item']['special_price'])
            <span class="text-muted"><s>{{ $product['item']['price'] }}</s></span>
            <br/>
            <span class="text-muted">{{ $product['item']['special_price'] }}</span>
          @else
            <span class="text-muted">{{ $product['item']['price'] }}</span>
          @endif
        </div>

        <div>
          <form>
            <div class="form-group">
            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $product['qty'] }}">
            </div>
          </form>
        </div>
      </li>

      @endforeach
    </ul>
    <hr class="mb-4">
    <div class="float-right">
      <h6>Total: <b>{{ $totalPrice }} {{$storefrontShop->shopCurrency}}</b></h6>
      <a href="{{ route('monk-shop-checkout') }}" class="btn btn-success">Proceed to Checkout</a>
    </div>
  @else
  <div class="row">
    <p class="lead">Your cart is empty</p>
  </div>
  @endif

  <br/>
  <br/>
  Have coupon code.
  Products. When if not in stock
  Total.
  Shipping etc.
</div>
@stop
