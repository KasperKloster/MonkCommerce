@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    Search Results
  @stop

  @section('content')
  <section>
	   <h1>Search Results</h1>
  </section>

  <section>
    <div class="row">
      @forelse($searchResults as $product)
      <div class="col-md-3 mb-4">
        <div class="card h-100">
        @foreach($product->images as $image)
        @if($image->main == True)
          <a href="{{ route('monk-shop-single-product', $product->slug) }}">
            <img src="{{ url('monkcommerce/images/products/' . $image->filename) }}" class="card-img-top img-thumbnail img-fluid" alt="{{ $product->name }}">
          </a>
        @endif
        @endforeach

        <div class="card-body">
          <h6 class="card-title">
            <a href="{{ route('monk-shop-single-product', $product->slug) }}">{{ $product->name }}</a>
          </h6>

          <!-- Attributes -->
          <div class="give-height mb-2">
          <ul class="list-inline card-subtitle text-muted">
          @foreach($product->attributeValues as $attr)
            <li class="list-inline-item vertical-divider mr-0">
              <small class="mr-1">{{ $attr->value }}</small>
            </li>
          @endforeach
          </ul>
        </div>

        <!-- Price -->
        @if(empty($product->special_price))
          <b>{{ showPrice($product->price) }}</b>
        @else
          <small class="text-muted"><s>{{ showPrice($product->price) }}</s></small><br/>
          <b>{{ showPrice($product->special_price) }}</b>
        @endif

        </div> <!-- /. card-body -->

        <div class="card-footer">
          <div class="d-flex justify-content-between">
            <form class="form-inline" action="{{ route('monk-shop-add-to-cart', ['id' => $product->id]) }}">
              @csrf
              <input type="hidden" name="id" value="{{ $product->id}}">
              <button type="submit" class="btn btn-outline-success btn-sm mat-inline-center"><i class="material-icons">shopping_cart</i>Add to Card</button>
            </form>
            <a href="{{ route('monk-shop-single-product', $product->slug) }}" class="btn btn-outline-info btn-sm">Read More</a>
          </div>
        </div>

      </div> <!-- /. card -->
      @empty
        <p>No Results...</p>
      @endforelse
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-center">
          {{ $searchResults->links() }}
        </div>
      </div>
    </div>

  </section>
  @stop
