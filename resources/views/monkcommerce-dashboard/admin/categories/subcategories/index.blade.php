@foreach($subs as $sub)
  {{ $sub->subcategory_name }}
  {{-- $sub->productCategories() --}}
  {{ $sub->productCategories->category_name }}



@endforeach
