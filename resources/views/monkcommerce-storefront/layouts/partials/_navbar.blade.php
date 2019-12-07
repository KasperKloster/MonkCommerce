<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{ $storefrontShop->shop_name }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('monk-shop-index') }}">Shop <span class="sr-only">(current)</span></a>
      </li>

      <!-- Categories -->
      @foreach($storefrontNavbarCategories as $category)
        <div>
        <li>
          <a href="{{ route('monk-shop-single-category', $category->slug) }}">
          {{ $category->name }}
          </a>
        </li>
        @foreach ($category->productChildrenCategories as $childCategory)
          <ul>
          @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar-child-category', ['child_category' => $childCategory])
          </ul>
        @endforeach
        </div>
      @endforeach
      <!-- Pages -->
      @foreach($storefrontStaticPages as $page)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('monk-shop-single-page', $page->slug) }}">{{ $page->name }} </a>
      </li>
      @endforeach
    </ul>

    <ul class="nav justify-content-end">
      <li class="nav-iten">
        <a class="nav-link" href="{{ route('monk-shop-cart-index') }}">
          <i class="material-icons">shopping_cart</i>Cart
          @if(Session::has('cart'))
            <span class="badge badge-dark">
              {{Session::get('cart')->totalQty}}
            </span>
          @endif
        </a>
      </li>

      <li>
        <a href="{{ route('monk-admin-home') }}">
          <i class="material-icons">account_circle</i>
        </a>
      </li>
    </ul>

  </div>
</nav>
