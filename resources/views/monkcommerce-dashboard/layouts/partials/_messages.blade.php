@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <h5 class="alert-heading"><b>Success!</b></h5>
  <hr>
  <p>{{ Session::get('success') }}</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h5 class="alert-heading"><b>Error!</b></h5>
    <hr>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
