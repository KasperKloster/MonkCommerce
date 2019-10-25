@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    {{ $category->name }}
  @stop

  @section('content')
	   <h1>{{ $category->name }}</h1>
     <p class="lead">{{ $category->description }}</p>
  @stop
