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
        <div class="card-header">{{ __('Secondary List') }}  <a href="{{ route('secondaries.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Secondary</a></div>
        <div class="card-body">
          <table id="myTable" class="table table-striped table-responsive">
            <tr>
              <th>S.NO.</th>
              <th>Secondary ID</th>
              <th>Secondary QR Code</th>
              <th>Primary QR Code</th>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Supplier Name & Batch Number</th>
              <th>Label Type</th>
              <th>Action</th>
            </tr>
            @if ($secondaries->isNotEmpty())
            @foreach ($secondaries as $secondary)
            <tr valign="middle">
              <td>{{ $secondary->company_name}}</td>
              <td>
                <a href="{{ route('secondaries.view', $secondary->id) }}" class="btn btn-primary btn-sm">View</a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="9">Record Not Found</td>
            </tr>
            @endif
          </table>
          <div class="mt-3">
            {{ $secondaries->links() }}
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