@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $product->name }}
  @stop
  @section('meta-desc'){{ Str::limit($product->description, $limit = 180, $end = '...') }}@stop
  @section('seo-robots')
    <link href="{{ url()->current() }}" rel="canonical">
  @stop
  @section('schema')
  <script type="application/ld+json">
    {
    "@context": "http://schema.org",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description }}",
    "sku": "{{ $product->sku }}",
    "image": "#",
      "offers": {
      "@type": "Offer",
      "url": "{{ url()->current() }}",
      @if($product->qty < 1)
      "availability": "http://schema.org/OutOfStock",
      @else
      "availability": "http://schema.org/InStock",
      @endif
      @if($product->special_price != NULL)
      "price": "{{ $product->special_price }}",
      @else
      "price": "{{ $product->price }}",
      @endif
      "priceCurrency": "{{ $storefrontShop->shopSchemaCurrency }}"
      }
    }
  </script>
  @stop

@section('content')

<section>
  <div class="row">
    <div class="col-md-6">
      @foreach($product->images as $prodImage)
        <img src="{{ url('monkcommerce/images/products/' . $prodImage->filename) }}" class="img-fluid" alt="{{ $product->name }}" />
      @endforeach
    </div>
    <div class="col-md-6">
      <h1>{{ $product->name }}</h1>
      <p>
      @if($product->special_price != NULL)
      <span class="show-price">{{ showPrice($product->special_price) }}</span>
      <s class="text-muted">{{ showPrice($product->price) }}</s>
      @else
      <span class="show-price">{{ showPrice($product->price) }}</span>
      @endif
      </p>
      <hr/>
      <p>{{ $product->description }}</p>
      <hr/>
      <!-- Loop Values -->
      <div class="row">
      @foreach($product->attributeValues as $attrVal)
        <div class="col">
        <!-- Loop Attr. -->
        @foreach($attrVal->attributes as $attr)
        <!-- Attr Name -->
        <b>{{ $attr->name }}</b>
        @endforeach
        <br/>
        <!-- Value Name -->
        {{ $attrVal->value }}
        </div>
      @endforeach
      </div>
      <hr/>
      <small>SKU: {{ $product->sku }} </small>
      @if($product->qty < 1)
      <p class="text-warning">Out of Stock</p>
      <button class="btn btn-primary btn-block mat-inline-center">Request Item</button>
      @else
      <p class="text-success">In Stock</p>
      <div class="row">
        <form class="form-inline" action="{{ route('monk-shop-add-to-cart', ['id' => $product->id]) }}">
          @csrf
          <input type="hidden" name="id" value="{{ $product->id}}">
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="minus" data-field="quant[1]">&minus;</button>
              </div>
              <input type="text" name="quant[1]" class="form-control input-number text-center" value="1" min="1" max="{{ $product->qty }}" aria-label="plus/minus">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus" data-field="quant[1]">&plus;</button>
              </div>
            </div>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
          </div>
        </form>
      </div>
      @endif
    </div>
  </div> <!-- /.row -->
</section>
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
