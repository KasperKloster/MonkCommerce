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
          <!-- Count child cats / if drop -->
          @if(count($category->productChildrenCategories) > 0)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $category->name }}
              </a>
              <!-- Dropdown Menu -->
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- First Drop / Main cat -->
                <a class="dropdown-item" href="{{ route('monk-shop-single-category', $category->slug) }}">
                  <h6 class="dropdown-header">{{ $category->name }}</h6>
                </a>
                <div class="dropdown-divider"></div>
                <!-- Childs -->
                @foreach ($category->productChildrenCategories as $childCategory)
                  @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar-child-category', ['child_category' => $childCategory])
                @endforeach
              </div>
          </li>
          @else
            <!-- Normal navitem -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('monk-shop-single-category', $category->slug) }}">
              {{ $category->name }}
              </a>
            </li>
          @endif
        </div>
      @endforeach
      <!-- Pages -->
      @foreach($storefrontStaticPages as $page)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('monk-shop-single-page', $page->slug) }}">{{ $page->name }} </a>
      </li>
      @endforeach
    </ul>

    <!-- Right -->
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link mat-inline-center" href="#">
        <i class="material-icons">search</i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link mat-inline-center" href="{{ route('monk-shop-cart-index') }}">
          <i class="material-icons">shopping_cart</i>
          @if(Session::has('cart'))
            <span class="badge badge-dark">
              {{Session::get('cart')->totalQty}}
            </span>
          @endif
        </a>
      </li>
      <!-- Login -->
      @include('monkcommerce::monkcommerce-shared.partials._navbar-admin')
    </ul>

  </div>
</nav>
