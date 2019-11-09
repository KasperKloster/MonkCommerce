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
      "offers": {
      "@type": "Offer",
      "url": "{{ url()->current() }}",
      "availability": "http://schema.org/InStock",
      "price": "{{ $product->price }}",
      "priceCurrency": "DKK"
      }
    }
  </script>
  @stop

  @section('content')
  <div class="container">
    <h1>{{ $product->name }}</h1>
    <p class="lead">{{ $product->description }}</p>

    <ul>
      <li>{{ $product->sku }}</li>
      <li>{{ $product->price }} {{$storefrontShop->shopCurrency}}</li>
      <li>{{ $product->special_price }} {{$storefrontShop->shopCurrency}}</li>
      <li>{{ $product->qty }}</li>
      <li>{{ $product->in_stock }}</li>
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
      @forelse($product->attributeValues as $attr)
        {{ $attr }}
        {{ $attr->value }}

      @empty
        <li></li>
      @endforelse
    </ul>
  </div>
  @stop
