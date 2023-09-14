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
<div style="margin:10px">
  <div class="row justify-content-center">
    <div class="d-flex justify-content-between py-3"></div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">{{ __('Product List') }}  <a href="{{ route('products.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Product</a></div>
        <div class="card-body">
          <form id="target" action="/delete-products" method="POST">
            @csrf
            <table id="tableContent" class="table table-striped" style="width:100%"> 
              <thead>
                <tr>
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
              </thead>
              <tbody>
                @if ($products->isNotEmpty())
                @foreach ($products as $product)
                <tr valign="middle">
                  <td>{{ $product->company_name}}</td>
                  <td>{{ $product->ProductName}}</td>
                  <td>
                    @if($product->is_secondary == 1)
                      Yes
                    @else
                      No
                    @endif
                  </td>
                  <td>{{ date('d-M-Y h:i:s a', strtotime($product->created_at))}}</td>
                  <td>{{ $product->ProductCode}}</td>
                  <td>{{ $product->ManufacturerName}}</td>
                  <td>{{ $product->SupplierName}}</td>
                  <td>{{ $product->Category->ItemCategoryName}}</td>
                  <td>{{ $product->SubCategory->SubCategoryName}}</td>
                  <td>{{ $product->BrandName}}</td>
                  <td>{{ $product->Weight}}</td>
                  <td>{{ $product->UnitOfMeasurement->UomName}}</td>
                  <td>
                    <a href="{{ route('products.view', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
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
    $('#tableContent').DataTable( {
      scrollX: true,
      fixedHeader: true,
      dom: 'Bfrtip',
      language: {
        emptyTable: "Currently no data available in table"
      },
      columnDefs: [
        {
          targets: 1,
          className: 'noVis'
        }
      ],
      buttons: [
        {
          extend: 'colvis',
          columns: ':not(.noVis)'
        },
        'copy', 'excel', 'pdf'
      ]
    });
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
</script>
@endsection