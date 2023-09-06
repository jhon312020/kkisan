@extends('layouts.defaultAdmin')
@section('content')
<br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            @if ( session('status') )
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <div class="container">
              <div class="row">
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left Dash-card1" style="background: #EF5B0C;color:white ">
                      <h6 class="mb-3 Dash-color1">Total Products</h6>
                      <h4 class="mb-1 Dash-color1 text-dark">{{$productCount}}</h4>
                      <p class="mb-2 text-muted"> </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left Dash-card2" style="background: #1746A2; color:white">
                      <h6 class="mb-3 Dash-color2">Total Labels </h6>
                      <h4 class="mb-1 Dash-color2 text-dark"> 0 </h4>
                      <p class="mb-2 text-muted"> </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left Dash-card3 " style="background: rgb(30, 213, 30);color:white">
                      <h6 class="mb-3 Dash-color3">Total Green Label</h6>
                      <h4 class="mb-1 Dash-color3 text-dark"> 0 </h4>
                      <p class="mb-2 text-muted"> </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left Dash-card4">
                      <h6 class="mb-3 Dash-color4"> Total White Big Label </h6>
                      <h4 class="mb-1 Dash-color4  text-dark"> 0 </h4>
                      <p class="mb-2 text-muted"> </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left Dash-card4">
                      <h6 class="mb-3 Dash-color4"> Total White Medium Label </h6>
                      <h4 class="mb-1 Dash-color4  text-dark"> 2 </h4>
                      <p class="mb-2 text-muted"> </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="card">
                    <div class="card-body iconfont text-left" style="background: #943785; color:#fff">
                      <h6 class="mb-3 Dash-color4" style="font-weight: bold;"> Total Small Label </h6>
                      <h4 class="mb-1" style="color: white; font-weight: bold;"> 10 </h4>
                      <p class="mb-2 text-muted"> </p>
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
