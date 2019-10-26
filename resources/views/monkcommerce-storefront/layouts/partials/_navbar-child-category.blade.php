<li>{{ $child_category->name }}</li>
@if ($child_category->productCategories)
    <ul>
        @foreach ($child_category->productCategories as $childCategory)
            @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar-child-category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
