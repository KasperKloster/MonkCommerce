@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $product->name }}
  @stop

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
	   <h1>{{ $product->name }}</h1>
     <p class="lead">{{ $product->description }}</p>
  @stop
