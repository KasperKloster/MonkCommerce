@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $product->name }}
  @stop
  @section('meta-desc'){{ Str::limit($product->description, $limit = 180, $end = '...') }}@stop

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
      "availability": "http://schema.org/InStock",
      "price": "{{ $product->price }}",
      "priceCurrency": "{{ $storefrontShop->shopSchemaCurrency }}"
      }
    }
  </script>
  @stop

  @section('content')
  <div class="container">
    <h1>{{ $product->name }}</h1>
    <p class="lead">{{ $product->description }}</p>

    <ul>
      <li>SKU: {{ $product->sku }} {{ $storefrontShop->shopSchemaCurrency }}</li>
      <li>Price: {{ $product->price }} {{$storefrontShop->shopCurrency}}</li>
      <li>Special Price: {{ $product->special_price }} {{$storefrontShop->shopCurrency}}</li>
      <li>Qty: {{ $product->qty }}</li>
    </ul>

    <h3>Product Belongs to categories:</h3>
    <ul>
      @foreach($product->productCategories as $category)
      <li>
        <a href="{{ route('monk-shop-single-category', $category->slug) }}">
        {{ $category->name }}
        </a>
      </li>
      @endforeach
    </ul>

    <h3>Attributes</h3>
    <ul>
      <!-- Loop Values -->
      @foreach($product->attributeValues as $attrVal)
        <!-- Loop Attr. -->
        @foreach($attrVal->attributes as $attr)
        <!-- Attr Name -->
          <li>{{ $attr->name }}</li>
        @endforeach
        <!-- Value Name -->
        <li>{{ $attrVal->value }}</li>
      @endforeach
    </ul>

    <h3>Product Images</h3>
    @foreach($product->images as $prodImage)
      <img src="{{ url('monkcommerce/images/products/' . $product->id . '/' . $prodImage->filename) }}" alt="{{ $product->name }}" />
    @endforeach

    <h3>Put i basket</h3>
    <a href="{{route('monk-shop-add-to-cart', $product->id)}}">Put in cart</a>
  </div>
  @stop
