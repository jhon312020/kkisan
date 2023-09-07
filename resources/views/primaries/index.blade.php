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
            <table id="myTable" class="table table-striped">
              <tr>
                <th>Label Created Date</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Product Weight</th>
                <th>Lable Type</th>
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
                <td>{{ \Carbon\Carbon::parse($primary->created_at)->format('d-M-Y h:i:sA') }}</td>
                <td>{{ $primary->product_name}}</td>
                <td>{{ $primary->product_code}}</td>
                <td>{{ $primary->weight}}</td>
                <td>{{ $primary->LabelType->name}}</td>
                <td>{{ $primary->quantity}}</td>
                <td>{{ $primary->batch_number}}</td>
                <td>{{ \Carbon\Carbon::parse($primary->manufacture_date)->format('d-M-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($primary->expiry_date)->format('d-M-Y') }}</td>
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
@endsection