@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')

<form class="needs-validation" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
@csrf
  <div class="card">
    <div class="card-header">
      {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }}
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">{{ ucwords(__('monkcommerce-dashboard.products.product_name')) }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Product Name" required>
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="sku">SKU</label>
          <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku') }}" required>
          @error('sku')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="description">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        @error('description')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="price">{{ ucwords(__('monkcommerce-dashboard.general-words.price')) }}</label>
          <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="249" required>
          @error('price')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col">
          <label for="special_price">{{ ucwords(__('monkcommerce-dashboard.general-words.special_price')) }}</label>
          <input type="text" class="form-control @error('special_price') is-invalid @enderror" id="special_price" name="special_price" value="{{ old('special_price') }}" placeholder="199">
          @error('special_price')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="qty">{{ ucwords(__('monkcommerce-dashboard.products.quantity')) }}</label>
          <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}" required>
          @error('qty')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col">
          <label for="weight">Weight</label>
          <div class="input-group">
            <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="1000" aria-label="Weight" aria-describedby="weight-addon">
            <div class="input-group-append">
              <span class="input-group-text" id="weight-addon">Gram</span>
            </div>
            @error('weight')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

      </div>

      <hr/>
      <div class="form-group row">
      @forelse($productAttributes as $attr)
        <div class="col-md-3 mb-3">
          <label for="productAttr">{{$attr->name}}</label>
          <select class="form-control" name="productAttr[]">
            <option value="NULL">Select</option>
            @foreach($attr->attributeValues as $value)
              <option value="{{$value->id}}">{{$value->value}}</option>
            @endforeach
          </select>
        </div>
      @empty
      <div></div>
      @endforelse
      </div>

      <div class="form-group">
        <label for="productCategories">{{ ucwords(__('monkcommerce-dashboard.categories.categories')) }}</label>
        <select multiple class="form-control" id="productCategories" name="productCategories[]" required>
          @foreach ($productCategories as $productCategory)
          <option value="{{$productCategory->id}}">{{ $productCategory->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- images -->
      <div id="valueGroup">
        <div class="form-group">
          <label aria-describedby="imageHelpBlock">{{ ucwords(__('monkcommerce-dashboard.products.image')) }}</label>
          <small id="imageHelpBlock" class="form-text text-muted">Main image will be used as the first image and thumbnail</small>
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile02" name="filename[]"/>
              <label class="custom-file-label mat-inline-center" for="inputGroupFile02"><i class="material-icons">folder_open</i>Choose file</label>
            </div>
            <div class="input-group-append">
              <button class="btn btn-primary addBtn">{{ ucwords(__('monkcommerce-dashboard.general-words.add')) }}</button>
              <button class="btn btn-warning removeBtn" type="button" id="inputGroupFileAddon04">{{ ucwords(__('monkcommerce-dashboard.general-words.remove')) }}</button>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- /. card-body -->

    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.products.create_product')) }}</button>
          <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('scripts')
<script>
// FileName (Input)
$(function($) {
  $(document).on('change', '.custom-file-input', function(event) {
    event.preventDefault();
    var fileName = $(this).val();
    $(this).next('.custom-file-label').html(fileName);
    console.log(fileName);
  });
});

// Add Input Btn
$(function($) {
  $(document).on('click', '.addBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('#valueGroup');

    target.append(
      '<div class="input-group mb-3">' +
        '<div class="custom-file">' +
          '<input type="file" class="custom-file-input id="inputGroupFile02" name="filename[]" />' +
          '<label class="custom-file-label mat-inline-center" for="inputGroupFile02"><i class="material-icons">folder_open</i>Choose file</label>' +
        '</div>' +
        '<div class="input-group-append">' +
          '<button class="btn btn-primary addBtn">{{ ucwords(__('monkcommerce-dashboard.general-words.add')) }}</button>' +
          '<button class="btn btn-warning removeBtn" type="button" id="inputGroupFileAddon04">{{ ucwords(__('monkcommerce-dashboard.general-words.remove')) }}</button>' +
        '</div>' +
      '</div>'
    );
  });
});

// Remove Input BTN
$(function($) {
  $(document).on('click', '.removeBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('.input-group').remove();
  });
});

</script>
@stop
