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

  @if(Session::has('cart'))
    <ul class="list-group">
      @foreach($products as $product)
      <li class="list-group-item d-flex justify-content-between lh-condensed">

        @foreach ($product['item']->images as $key)
          @if($key['main'] == 1)
            <div class="col-md-2">
              <img class="img-thumbnail img-fluid float-left" src="{{ url('monkcommerce/images/products/' . $key['filename']) }}" title="{{ $product['item']['name'] }}">
            </div>
          @endif
        @endforeach

        <div class="col-md-4">
          <h6 class="my-0"><a href="{{route('monk-shop-single-product', 1)}}">{{ $product['item']['name'] }}</a></h6>
          @for ($i = 0; $i < count($product['item']['attributeValues']); $i++)
            | <small class="text-muted">{{ $product['item']['attributeValues'][$i]['value'] }}</small>
          @endfor
        </div>

        <div>
          @if ($product['item']['special_price'])
            <span class="text-muted"><s>{{ showPrice($product['item']['price']) }}</s></span>
            <br/>
            <span class="text-muted">{{ showPrice($product['item']['special_price']) }}</span>
          @else
            <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
          @endif
        </div>

        <div>
          <form class="form-inline" action="#">
            @csrf
            <div class="col-md-5">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="minus" data-field="quant[1]">&minus;</button>
                </div>
                <input type="text" name="quant[1]" class="form-control input-number text-center" value="{{$product['qty']}}" min="1" max="2" aria-label="plus/minus">
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus" data-field="quant[1]">&plus;</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </li>

      @endforeach
    </ul>
    
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

// Increase / Decrease Field
$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

</script>
@stop
