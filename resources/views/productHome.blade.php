@extends('layouts.defaultAdmin')
@section('content')
<br>
<div class="container">
  <div class="row justify-content-center">
    @if (Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif
  </div>
</div>
<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="d-flex justify-content-between py-3"></div>
    <div class="col-md-12">
      <div class="card">
            <div class="card-header">{{ __('Product List') }}  <a href="{{ route('products.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Product</a></div>
        <div class="card-body">
          <!-- <form method="GET" class="col-6">
            <div class="form-group">
              <input type="search" name="search" value="" class="form-control" placeholder="Search by Position" aria-label="Search" aria-describedby="button-addon2">
            </div>
            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons" style="font-size:15px">&#xe8b6;</i> Search</button>
            <a href="{{ url('/productHome') }}">
              <button class="btn btn-primary" type="button"><i class="material-icons" style="font-size:15px">&#xe86a;</i> Reset</button>
            </a>
          </form>
          <br> -->
          <form id="target" action="/delete-products" method="POST">
            @csrf
            <table id="myTable" class="table table-striped">
              <tr>
          <!--       <th>
                  <div class="form-check form-switch">
                    <input type="checkbox" id="selectAll">
                  </div>
                </th> -->
                <th>Company Name</th>
                <th>Product Name</th>
                <th>Is Secondary is there</th>
                <th>Product Created Date</th>
                <th>Product Code</th>
                <th>Manufacturer Name</th>
                <th>Supplier Name</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Brand Name</th>
                <th>Weight</th>
                <th>Unit of Measurement</th>
                <th>Action</th>
              </tr>
              @if ($products->isNotEmpty())
              @foreach ($products as $product)
              <tr valign="middle">
           <!--      <td>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="dynamicCheckbox" name="ids[{{ $product->id }}]" value="{{ $product->id }}" id="{{ $product->id }}">
                  </div>
                </td> -->
                <td>{{ $product->company_name}}</td>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->secondary}}</td>
                <td>{{ $product->created_at}}</td>
                <td>{{ $product->product_code}}</td>
                <td>{{ $product->manufacturer_name}}</td>
                <td>{{ $product->supplier_name}}</td>
                <td>{{ $product->category}}</td>
                <td>{{ $product->sub_category}}</td>
                <td>{{ $product->brand_name}}</td>
                <td>{{ $product->weight}}</td>
                <td>{{ $product->uomid}}</td>
                <td>
                  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i> Edit</a>
                  <!-- <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i> Edit</a> -->
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6">Record Not Found</td>
              </tr>
              @endif
            </table>
            <!-- <button type="button" value="Delete products" onclick="deleteproducts();" class="btn btn-danger" for="Delete products"><i class="material-icons" style="font-size:15px">&#xe872;</i> Delete product</button> -->
          </form>
          <div class="mt-3">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#selectAll').click(function() {
      $('.dynamicCheckbox').prop('checked', $(this).prop('checked'));
    });
    $('.dynamicCheckbox').click(function() {
      if ($('.dynamicCheckbox:checked').length === $('.dynamicCheckbox').length) {
        $('#selectAll').prop('checked', true);
      } else {
        $('#selectAll').prop('checked', false);
      }
    });
  });

  function deleteproducts() {
    event.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete this!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#target").submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'product is safe :)',
          'error'
        )
      }
    })
  }
  $(document).ready( function () {
        $('#myTable').DataTable({
            // DataTables options and configurations go here
        });
    });
</script>
@endsection