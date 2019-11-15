<div class="form-row mt-2 mb-2">
  <div class="col-md-1"></div>
    <div class="col">
      <li>
      {{ $child_category->name }}
      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('monk-admin-edit-category', $childCategory->id) }}" class="btn btn-sm btn-info mat-inline-center"><i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}</a>
        <a href="{{ route('monk-admin-create-category', ['parentCat' => $childCategory->id])}}" class="btn btn-sm btn-success mat-inline-center"><i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}</a>
        <a href="{{ route('monk-shop-single-category', $childCategory->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center">{{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i></a>
        <a href="{{ route('monk-admin-destroy-category', $childCategory->id) }}" class="btn btn-sm btn-danger mat-inline-center"><i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}</a>
      </div>
      </li>
  </div>
</div>

@if ($child_category->productCategories)
<div class="form-row">
  <div class="col-md-1"></div>
    <div class="col">
    @foreach ($child_category->productCategories as $childCategory)
      @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
    @endforeach
    </div>
</div>
@endif
