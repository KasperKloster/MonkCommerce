<aside id="cart-sidebar">
  <div class="col-md-12">
    <h3 class="d-flex justify-content-between align-items-center mb-3">
      Cart
      <span class="badge badge-pill step-color-active">{{ $cart->totalQty }}</span>
    </h3>
    @foreach($products as $product)

    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <!-- Image -->
        @foreach($product['item']['images'] as $image)
          @if($image['main'] == 1)
            <div>
              <img class="img-thumbnail img-fluid float-left product-img" src="{{ url('monkcommerce/images/products/' . $image['filename']) }}" title="{{ $product['item']['name'] }}">
            </div>
          @endif
        @endforeach
        <div>
          <h6 class="my-0">
            <a href="{{route('monk-shop-single-product', $product['item']['slug'])}}">{{ $product['item']['name'] }}</a>
          </h6>
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
        <!-- Prices -->
        <div class="text-center">
        @if ($product['item']['special_price'])
          <span class="text-muted">
            <small><s>{{ showPrice($product['item']['price']) }}</s></small>
            <br/>
            <b>{{ showPrice($product['item']['special_price']) }}</b>
          </span>
        @else
          <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
        @endif
        </div>
      </li>
      @endforeach
      <li class="list-group-item d-flex justify-content-between bg-light">
        <span>Shipping</span>
        <i>Choose later</i>
      </li>
      <li class="list-group-item d-flex justify-content-between bg-light">
        <span>Subtotal</span>
        {{ showPrice($cart->totalPrice) }}</strong>
      </li>
      <li class="list-group-item d-flex justify-content-between bg-light">
        Total <b><u>{{ showPrice($cart->totalPrice) }}</u></b>
      </li>
    </ul>
  </div>
</aside>
