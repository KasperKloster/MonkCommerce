@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.products.edit_product')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  <div class="card">
    <div class="card-header">
      {{ ucwords(__('monkcommerce-dashboard.products.edit_product')) }}
      <br/>
      <small>
        <a href="{{ route('monk-shop-single-product', $product->slug)}}" target="_blank">
          Show in Shop
        </a>
      </small>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="productName">{{ ucwords(__('monkcommerce-dashboard.products.product_name')) }}</label>
        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name }}" required>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productSku">SKU</label>
          <input type="text" class="form-control" id="productSku" name="productSku" value="{{ $product->sku }}" required>
        </div>
      </div>

      <div class="form-group">
        <label for="productDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
        <textarea class="form-control" id="productDescription" name="productDescription" rows="3">{{ $product->description }}</textarea>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.price')) }}</label>
          <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $product->price }}" required>
        </div>
        <div class="col">
          <label for="productSpecialPrice">{{ ucwords(__('monkcommerce-dashboard.general-words.special_price')) }}</label>
          <input type="text" class="form-control" id="productSpecialPrice" name="productSpecialPrice" value="{{ $product->special_price }}">
        </div>
      </div>

      <div class="form-group row">
        <div class="col">
          <label for="productQty">{{ ucwords(__('monkcommerce-dashboard.products.quantity')) }}</label>
          <input type="text" class="form-control" id="productQty" name="productQty" value="{{ $product->qty }}" required>
        </div>

        <div class="col">
          <label for="productWeight">Weight</label>
          <div class="input-group">
            <input type="text" class="form-control" id="productWeight" name="productWeight" value="{{ $product->weight }}" aria-label="Weight" aria-describedby="weight-addon">
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
              <option value="{{ $value->id }}"
              @forelse($product->attributeValues as $attr)
                @if($value->id == $attr->id)
                  selected
                @endif
              @empty
                ''
              @endforelse
                >{{$value->value}}</option>
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
          <option value="{{$productCategory->id}}"
            @foreach($product->productCategories as $category)
              @if($category->id == $productCategory->id)
                selected
              @endif
            @endforeach
            >{{ $productCategory->name }}</option>
          @endforeach
        </select>
      </div>

      <hr/>
      <!-- Images -->
      <div id="valueGroup">
        <div class="form-row">
          <div class="card-deck">
            <!-- OrgImages -->
            @foreach($product->images as $image)
            <div class="card">
              <div class="card-header">
                <div class="float-right">
                  <button class="btn btn-danger btn-sm mat-inline-center removeImg"><i class="material-icons">delete_forever</i></button>
                </div>
              </div>

              <img src="{{ url('monkcommerce/images/products/' . $image->filename) }}" class="card-img-top">
              <input type="hidden" value="{{ $image->filename }}" name="delOrgImages[{{$image->id}}]">
              <div class="card-footer p-4">
                <div class="form-group">
                  <input type="radio" value="{{ $image->id }}" name="mainImg[]"
                  {{ $image->main }}
                  @if ($image->main == '1')
                    checked
                  @endif
                  >
                  <label class="form-check-label" for="exampleCheck1"><small>Main Image</small></label>
                </div>
              </div>
            </div>
            <input type="hidden" value="{{ $image->filename }}" name="orgImages[{{$image->id}}]">
            @endforeach
          </div>
        </div> <!-- /.form-row-->
        <div class="form-row mt-4">
          <!-- New Images -->
          <label for="filename">{{ ucwords(__('monkcommerce-dashboard.products.image')) }}</label>
          <div class="col">
            <input type="file" class="form-control-file" name="filename[]">
          </div>
          <div class="col">
            <button class="btn btn-primary addBtn">{{ ucwords(__('monkcommerce-dashboard.general-words.add')) }}</button>
          </div>
        </div>
      </div> <!-- /#valueGroup -->
    </div> <!-- /.card-body -->

    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.general-words.update')) }}</button>
          <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('scripts')
<script>
// Add Row Btn
$(function($) {
  $(document).on('click', '.addBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('#valueGroup');
    target.append("<div class='form-row mt-2'><label for='filename'>{{ ucwords(__('monkcommerce-dashboard.products.image')) }}</label><div class='col'><input type='file' class='form-control-file' name='filename[]'></div><div class='col'><button class='btn btn-primary addBtn mr-1'>{{ ucwords(__('monkcommerce-dashboard.general-words.add')) }}</button><button class='btn btn-warning removeBtn'>{{ ucwords(__('monkcommerce-dashboard.general-words.remove')) }}</button></div></div>");
  });
});
// Remove Row BTN
$(function($) {
  $(document).on('click', '.removeBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('.form-row').remove();
  });
});

//Remove image BTN
$(function($) {
    $(document).on('click', '.removeImg', function(event) {
      event.preventDefault();
      var target = $(event.target).closest('.card').remove();
    });
  });

</script>
@stop
