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
        @for ($i = 0; $i < count($product['item']['attribute_values']); $i++)
          | <small class="text-muted">{{ $product['item']['attribute_values'][$i]['value'] }}</small>
        @endfor
        <br/>
        @if ($product['item']['special_price'])
          <span class="text-muted"><small><s>{{ showPrice($product['item']['price']) }}</s></small></span>
          <br/>
          <span class="text-muted">{{ showPrice($product['item']['special_price']) }}</span>
        @else
          <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
        @endif
      </div>

      <div>
        <form class="form-inline" action="#" id="quant_{{ $product['item']['id'] }}">
          @csrf
          <div class="col-md-5">
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="minus" data-field="quant[1]">&minus;</button>
              </div>
              <input type="text" name="quant[1]" class="form-control input-number text-center" value="{{ $product['qty'] }}" min="1" max="{{ $product['item']['qty'] }}" aria-label="plus/minus">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus" data-field="quant[1]">&plus;</button>
              </div>
            </div>
          </div>
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

  <hr class="mb-4">
  <div class="float-right">
    <h6>Total: <b>{{ showPrice($totalPrice) }}</b></h6>
    <a href="{{ route('monk-shop-checkout') }}" class="btn btn-success">Proceed to Checkout</a>
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

// // Increase / Decrease Field
// $('.btn-number').click(function(e){
//     e.preventDefault();
// //  var id = $(this).closest('.input-group').find('input').first().attr('id');
// //  console.log($(this).closest('.input-group').find('input').first().val());
//
//     fieldName = $(this).attr('data-field');
//     type      = $(this).attr('data-type');
//     //var input = $(this).closest('.input-group').find('input').first().attr('id');
//     var input = $("input[name='"+fieldName+"']");
//     var currentVal = parseInt(input.val());
//
//
//     if (!isNaN(currentVal)) {
//         if(type == 'minus') {
//
//             if(currentVal > input.attr('min')) {
//                 input.val(currentVal - 1).change();
//             }
//             if(parseInt(input.val()) == input.attr('min')) {
//                 $(this).attr('disabled', true);
//             }
//
//         } else if(type == 'plus') {
//
//             if(currentVal < input.attr('max')) {
//                 input.val(currentVal + 1).change();
//             }
//             if(parseInt(input.val()) == input.attr('max')) {
//                 $(this).attr('disabled', true);
//             }
//
//         }
//     } else {
//         input.val(0);
//     }
// });

</script>
@stop
