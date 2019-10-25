<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Shopname</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('monk-shop-index') }}">Shop <span class="sr-only">(current)</span></a>
      </li>
      <!-- Categories -->
      @foreach ($storefrontNavbarCategories as $category)
        @if ($category->show_in_menu == '1')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $category->name }}
          </a>
          <!-- Subcategories -->
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('monk-shop-single-category', [$category->slug, 'cat' => 'main']) }}">{{ $category->name }}</a>
            @foreach($storefrontNavbarSubCategories as $subcategory)
              @if($category->id == $subcategory->product_category_id && $subcategory->show_in_menu == '1')
              <a class="dropdown-item" href="{{ route('monk-shop-single-category', [$subcategory->slug, 'cat' => 'sub']) }}">{{ $subcategory->name }}</a>
              @endif
            @endforeach
          </div>
        </li>
        @endif
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
