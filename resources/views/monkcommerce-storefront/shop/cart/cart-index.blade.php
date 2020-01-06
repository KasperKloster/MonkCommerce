@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    Cart
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop

@section('content')
<div class="container">
  <h2>Cart</h2>
  @if(Session::get('cart'))
  <ul class="list-group">
    @foreach($products as $product)
    <li class="list-group-item d-flex justify-content-between lh-condensed">

      @foreach ($product['item']['images'] as $key)
        @if($key['main'] == 1)
          <div class="col-md-2">
            <img class="img-thumbnail img-fluid float-left" src="{{ url('monkcommerce/images/products/' . $key['filename']) }}" title="{{ $product['item']['name'] }}">
          </div>
        @endif
      @endforeach

      <div class="col-md-4">
        <h6 class="my-0"><a href="{{route('monk-shop-single-product', $product['item']['slug'])}}">{{ $product['item']['name'] }}</a></h6>
        <small class="text-muted">
          <ul class="list-inline">
            @for ($i = 0; $i < count($product['item']['attribute_values']); $i++)
            <li class="list-inline-item vertical-divider mr-0">
              <span class="mr-1">{{ $product['item']['attribute_values'][$i]['value'] }}</span>
            </li>
            @endfor
          </ul>
        </small>
        @if ($product['item']['special_price'])
          <span class="text-muted"><small><s>{{ showPrice($product['item']['price']) }}</s></small></span>
          <br/>
          <span class="text-muted">{{ showPrice($product['item']['special_price']) }}</span>
        @else
          <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
        @endif
      </div>

      <div>
        <form class="form-inline" action="{{ route('monk-shop-add-to-cart', $product['item']['id']) }}" id="quant_{{ $product['item']['id'] }}">
          @csrf
          <div class="col-md-5">
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="minus" data-field="quant[1]">&minus;</button>
              </div>
              <input id="input-number-{{ $product['item']['id'] }}" type="text" name="quant[1]" class="form-control input-number text-center" value="{{ $product['qty'] }}" min="1" max="{{ $product['item']['qty'] }}" aria-label="plus/minus">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus" data-field="quant[1]">&plus;</button>
              </div>
            </div>
          </div>
          <button class="btn btn-outline-secondary btn-sm mat-inline-center" type="submit">
            <i class="material-icons">cached</i>
          </button>
        </form>
      </div>

      <div>
        <a href="{{ route('monk-shop-remove-from-cart', $product['item']['id']) }}">
          <i class="material-icons">close</i>
        </a>
      </div>

    </li>
  </ul>
  @endforeach

  <div class="float-right mt-4">
    <h6><b>Total:</b> <u>{{ showPrice($totalPrice) }}</u></h6>
    <a href="{{ route('monk-shop-checkout-billing') }}" class="btn btn-success">Proceed to Checkout</a>
  </div>

  @else
    <div class="row">
      <p class="lead">Your cart is empty</p>
    </div>
  @endif
</div>
@stop

@section('scripts')
<script>

// Increase / Decrease Field
$('.btn-number').click(function(e){
    e.preventDefault();
    // Find clicked Item by ID
    let inputId = $(this).closest('.input-group').find('input').first().attr('id');
    // Max In stock
    let inputMax = $(this).closest('.input-group').find('input').first().attr('max');
    // Minus or plus?
    let type = $(this).attr('data-type');

    if (type == 'minus')
    {
      let currValue = $(this).closest('.input-group').find('input').first().val();
      // Decrement current value
      let newValue = currValue - 1;
      // Set new Value if greater than 1
      if (newValue > 0)
      {
        $(this).closest('.input-group').find('input').first().val(newValue);
      }
    }

    if (type == 'plus')
    {
      let currValue = $(this).closest('.input-group').find('input').first().val();
      // Increment
      let newValue = currValue++;
      if (newValue < inputMax)
      {
          $(this).closest('.input-group').find('input').first().val(currValue++);
      }

    }
});

</script>
@stop
