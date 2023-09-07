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
            <table id="myTable" class="table table-striped table-responsive" style="width:100%"> 
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
              @if ($products->isNotEmpty())
              @foreach ($products as $product)
              </tbody>
              <tr valign="middle">
                <td>{{ $product->company_name}}</td>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->secondary}}</td>
                <td>{{ $product->created_at}}</td>
                <td>{{ $product->product_code}}</td>
                <td>{{ $product->manufacturer_name}}</td>
                <td>{{ $product->supplier_name}}</td>
                <td>{{ $product->category_name}}</td>
                <td>{{ $product->sub_category_name}}</td>
                <td>{{ $product->brand_name}}</td>
                <td>{{ $product->weight}}</td>
                <td>{{ $product->uomid}}</td>
                <td>
                  <a href="{{ route('products.view', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6">Record Not Found</td>
              </tr>
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
    // $('#myTable').DataTable( {
    //   responsive: true,
    //   fixedHeader: true,
    //    dom: 'Bfrtip',
    //     columnDefs: [
    //         {
    //             targets: 1,
    //             className: 'noVis'
    //         }
    //     ],
    //     buttons: [
    //         {
    //             extend: 'colvis',
    //             columns: ':not(.noVis)'
    //         },
            
    //           'copy', 'excel', 'pdf'
            
    //     ]
    
    // });
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