@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $category->name }}
  @stop

  @section('content')
  <div class="container">
    <h1>{{ $category->name }}</h1>
    <p class="lead">{{ $category->description }}</p>

    <h3>Products in this category</h3>
      <ul>
      @foreach($category->products as $product)
        <li>
          <a href="{{route('monk-shop-single-product', $product->slug)}}">
            {{$product->name}}
          </a>
        </li>
      @endforeach
      </ul>

  </div>
  @stop
