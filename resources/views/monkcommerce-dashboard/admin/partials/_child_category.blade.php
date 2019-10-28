<li>
{{ $child_category->name }}
  <!-- edit -->
  <a href="{{ route('monk-admin-edit-category', $childCategory->id) }}" class="btn btn-sm btn-info mat-inline-center">
    <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
  </a>
  <!-- create subcategory -->
  <a href="{{ route('monk-admin-create-category', ['parentCat' => $childCategory->id])}}" class="btn btn-sm btn-success mat-inline-center ml-3">
    <i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}
  </a>
  <!-- show in shop -->
  <a href="{{ route('monk-shop-single-category', $childCategory->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
    {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
  </a>
  <!-- Delete Category -->
  <a href="{{ route('monk-admin-destroy-category', $childCategory->id) }}" class="btn btn-sm btn-danger mat-inline-center">
    <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
  </a>
</li>
@if ($child_category->productCategories)
    <ul>
      @foreach ($child_category->productCategories as $childCategory)
          @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
      @endforeach
    </ul>
@endif

{{-- <div class="card border-top" style="margin-left:20px;">
  <div class="card-header">
    <!-- Header -->
    <div class="d-flex justify-content-start">
      <b>{{ $childCategory->name }}</b>
    </div>
    <!-- Buttons -->
    <div class="d-flex justify-content-end">
      <!-- edit -->
      <a href="{{ route('monk-admin-edit-category', $childCategory->id) }}" class="btn btn-sm btn-info mat-inline-center">
        <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
      </a>
      <!-- create subcategory -->
      <a href="{{ route('monk-admin-create-category', ['parentCat' => $category->id])}}" class="btn btn-sm btn-success mat-inline-center ml-3">
        <i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}
      </a>
      <!-- show in shop -->
      <a href="{{ route('monk-shop-single-category', $childCategory->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
        {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
      </a>
      <!-- Delete Category -->
      <a href="#" class="btn btn-sm btn-danger mat-inline-center">
        <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
      </a>
    </div>
  </div>
</div>

@if ($child_category->productCategories)
  @foreach ($child_category->productCategories as $childCategory)
      @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
  @endforeach
@endif --}}
