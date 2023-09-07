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
<div class="m-5">
  <div class="row justify-content-center">
    <div class="d-flex justify-content-between py-3"></div>
    <div class="col-md-12">
      <div class="card">
            <div class="card-header">{{ __('Primary List') }}  <a href="{{ route('primaries.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Primary</a></div>
        <div class="card-body">
          <!-- <form method="GET" class="col-6">
            <div class="form-group">
              <input type="search" name="search" value="" class="form-control" placeholder="Search by Position" aria-label="Search" aria-describedby="button-addon2">
            </div>
            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons" style="font-size:15px">&#xe8b6;</i> Search</button>
            <a href="{{ url('/primaryHome') }}">
              <button class="btn btn-primary" type="button"><i class="material-icons" style="font-size:15px">&#xe86a;</i> Reset</button>
            </a>
          </form>
          <br> -->
          <form id="target" action="/delete-primaries" method="POST">
            @csrf
            <table id="myTable" class="table table-striped">
              <tr>
          <!--       <th>
                  <div class="form-check form-switch">
                    <input type="checkbox" id="selectAll">
                  </div>
                </th> -->
                <th>Label Created Date</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Product Weight</th>
                <th>No. of Lables</th>
                <th>Bathch Number</th>
                <th>Manufacturing Date</th>
                <th>Expiry Date</th>
                <th>MRP</th>
                <th>Action</th>
              </tr>
              @if ($primaries->isNotEmpty())
              @foreach ($primaries as $primary)
              <tr valign="middle">
           <!--      <td>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="dynamicCheckbox" name="ids[{{ $primary->id }}]" value="{{ $primary->id }}" id="{{ $primary->id }}">
                  </div>
                </td> -->
                <td>{{ $primary->created_at}}</td>
                <td>{{ $primary->product_name}}</td>
                <td>{{ $primary->product_code}}</td>
                <td>{{ $primary->weight}}</td>
                <td>{{ $primary->quantity}}</td>
                <td>{{ $primary->batch_number}}</td>
                <td>{{ $primary->manufacture_date}}</td>
                <td>{{ $primary->expiry_date}}</td>
                <td>{{ $primary->mrp}}</td>
                <td>
                  <a href="{{ route('primaries.view', $primary->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i>View</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6">Record Not Found</td>
              </tr>
              @endif
            </table>
          </form>
          <div class="mt-3">
            {{ $primaries->links() }}
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

  function deleteprimaries() {
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
          'Primary is safe :)',
          'error'
        )
      }
    })
  }
</script>
@endsection