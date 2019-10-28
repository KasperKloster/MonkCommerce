
<li>
  <a href="{{ route('monk-shop-single-category', $child_category->slug) }}">
    {{ $child_category->name }}
  </a>
</li>

@if ($child_category->productCategories)
    <ul>
        @foreach ($child_category->productCategories as $childCategory)
            @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar-child-category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
