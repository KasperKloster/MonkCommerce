@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<form method="post" action="{{ route('monk-admin-store-product') }}" enctype="multipart/form-data">
@csrf
  <div class="card">
    <div class="card-header">
      {{ ucwords(__('monkcommerce-dashboard.products.create_new_product')) }}
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="productName">{{ ucwords(__('monkcommerce-dashboard.products.product_name')) }}</label>
        <input type="text" class="form-control" id="productName" name="productName" value="{{ old('productName') }}" placeholder="Product Name" required>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productSku">SKU</label>
          <input type="text" class="form-control" id="productSku" name="productSku" value="{{ old('productSku') }}" required>
        </div>
      </div>

      <div class="form-group">
        <label for="productDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
        <textarea class="form-control" id="productDescription" name="productDescription" rows="3">{{ old('productDescription') }}</textarea>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.price')) }}</label>
          <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ old('productPrice') }}" placeholder="249" required>
        </div>
        <div class="col">
          <label for="productSpecialPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.special_price')) }}</label>
          <input type="text" class="form-control" id="productSpecialPrice" name="productSpecialPrice" value="{{ old('productSpecialPrice') }}" placeholder="199">
        </div>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productQty">{{ ucwords(__('monkcommerce-dashboard.products.quantity')) }}</label>
          <input type="text" class="form-control" id="productQty" name="productQty" value="{{ old('productQty') }}" required>
        </div>

        <div class="col">
          <label for="productWeight">Weight</label>
          <div class="input-group">
            <input type="text" class="form-control" id="productWeight" name="productWeight" placeholder="1000" aria-label="Weight" aria-describedby="weight-addon">
            <div class="input-group-append">
              <span class="input-group-text" id="weight-addon">Gram</span>
            </div>
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
