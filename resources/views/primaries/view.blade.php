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
          <div class="card-header"><a href="{{ route('primaries.printLabel', $primary->id) }}" style="float:right; 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i> Print Label</a></div>
          <div class=" mb-0">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="Content-header1 col-lg-12">
                    <h3 class="mb-0 m-t-5 m-b-5 text-center">
                      {{$primary->product_name}}
                    </h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->product_code}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->manufacturer_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->supplier_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->category_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->sub_category_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->manufacturer_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->quantity}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->weight}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->brand_name}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->manufacture_date}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->expiry_date}}</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">{{$primary->mrp}}</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Min.) 98%</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Max.)2.0%</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Max.)10/Kg</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Max.)10/Kg</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Min.)80%</h4>
                  </div>
                  <div class="col-sm-3">
                      <h4 class="text-center">(Min.)10%</h4>
                  </div>
                  <div class="col-sm-3">
                    <h4 class="text-center">
                      <img src="no" width="50px" alt="">
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
@endsection