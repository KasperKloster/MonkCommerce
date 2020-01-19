@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $page->name }}
  @stop
  @section('meta-desc'){{ Str::limit($page->description, $limit = 180, $end = '...') }}@stop

  @section('schema')
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebPage",
        "name": "{{$page->name}}",
        "description": "{{ Str::limit($page->description, $limit = 180, $end = '...') }}",
    }
    </script>
  @stop

  @section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ $page->name }}</h1>
        <p class="lead">{{ $page->description }}</p>
      </div>
    </div>
  </div>
  @stop
