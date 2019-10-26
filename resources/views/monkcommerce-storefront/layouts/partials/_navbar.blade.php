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
        <li>{{ $category->name }}</li>
        @foreach ($category->productChildrenCategories as $childCategory)
          <ul>
          @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar-child-category', ['child_category' => $childCategory])
          </ul>
        @endforeach
      @endforeach

    </ul>

    <ul class="nav justify-content-end">
      <li>
        <a href="{{ route('monk-admin-home') }}">
          <i class="material-icons">account_circle</i>
        </a>
      </li>
    </ul>

  </div>
</nav>
