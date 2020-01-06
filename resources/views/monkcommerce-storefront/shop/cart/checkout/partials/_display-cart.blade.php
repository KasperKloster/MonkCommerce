<div class="col-md-12">
  <h3 class="d-flex justify-content-between align-items-center mb-3">
    Cart
    <span class="badge badge-secondary badge-pill">{{ $cart->totalQty }}</span>
  </h3>
  @foreach($products as $product)
  <ul class="list-group mb-3">
    <li class="list-group-item d-flex justify-content-between lh-condensed">
      <div>
        <h6 class="my-0"><a href="{{route('monk-shop-single-product', $product['item']['slug'])}}">{{ $product['item']['name'] }}</a></h6>
        <small class="text-muted">
          <ul class="list-inline">
            @for ($i = 0; $i < count($product['item']['attribute_values']); $i++)
              <li class="list-inline-item vertical-divider mr-0">
                <span class="mr-1">{{ $product['item']['attribute_values'][$i]['value'] }}<span>
              </li>
            @endfor
          </ul>
        </small>
      </div>
      @if ($product['item']['special_price'])
        <span class="text-muted"><s>{{ showPrice($product['item']['price']) }}</s></span>
        <span class="text-muted">{{ showPrice($product['item']['special_price']) }}</span>
      @else
        <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
      @endif
    </li>
    @endforeach
    <li class="list-group-item d-flex justify-content-between bg-light font-weight-bold">
      <span>Shipping</span>
      <i>Calculated later</i>
    </li>
    <li class="list-group-item d-flex justify-content-between bg-light font-weight-bold">
      <span>Subtotal</span>
      <u>{{ showPrice($cart->totalPrice) }}</u></strong>
    </li>
    <li class="list-group-item d-flex justify-content-between bg-light font-weight-bold">
      Total
    </li>
  </ul>
</div>
