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
          <form id="target" action="/delete-primaries" method="POST">
            @csrf
            <table id="tableContent" class="table table-striped">
              <thead>
                <tr>
                  <th>Label Created Date</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Weight</th>
                  <th>Label Type</th>
                  <th>No. of Labels</th>
                  <th>Batch Number</th>
                  <th>Manufacturing Date</th>
                  <th>Expiry Date</th>
                  <th>MRP</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @if ($primaries->isNotEmpty())
              @foreach ($primaries as $primary)
              <tr valign="middle">
                <td>{{ date('d-M-Y h:i:s a', strtotime($primary->created_at))}}</td>
                <td>{{ $primary->Product->ProductName}}</td>
                <td>{{ $primary->Product->ProductCode}}</td>
                <td>{{ $primary->weight}} {{ $primary->UnitOfMeasurement->UomName}}</td>
                <td>{{ $primary->LabelType->name}}</td>
                <td>{{ $primary->quantity}}</td>
                <td>{{ $primary->BatchNumber}}</td>
                <td>{{ date('d-M-Y', strtotime($primary->ManufactureDate))}}</td>
                <td>{{ date('d-M-Y', strtotime($primary->ExpiryDate))}}</td>
                <td>{{ $primary->mrp}}</td>
                <td>
                  <a href="{{ route('primaries.view', $primary->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i>View</a>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
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
<script type='text/javascript'>
  $(document).ready(function() {
    $('#tableContent').DataTable( {
      fixedHeader: true,
      scrollX: true,
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
          className: 'btn-primary',
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
</script>
@endsection