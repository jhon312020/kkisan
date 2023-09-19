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
    <br>
    <div class="row">
      <div class="col-12"> 
        <div class="card" id="printMe">
          <div class="card-header"><h3>Secondary ID Details: {{$secondary->SecondaryContainerCode}}</h3></div>
          <div class=" mb-0">
            <div class="card-body">
              <table border="1" width="100%">
                <thead>
                  <tr>
                    <th>PRIMARY LABELS ID</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $secLabelDetails = json_decode($secondary->SecondaryLabelDetail, true);
                  ?>
                  @foreach ($secLabelDetails as $secLabel)
                  <tr>
                    <td>{{$secLabel['QRCode']}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
@endsection