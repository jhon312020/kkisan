@extends('layouts.defaultAdmin')
@section('content')
<br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">{{ __('Dashboard') }}</div>

          <div class="card-body">
            @if ( session('status') )
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <div class="container">
                <h2>Profile</h2>
                <h2>Welcome {{ auth()->user()->name }}!</h2>
                <hr>
                <h4>MY INFO:</h4>
                <h4>Name:{{ auth()->user()->name }} </h4>
                <h4>Email: {{ auth()->user()->email }}</h4>
                <h4>Mobile Number:{{auth()->user()->phone}} </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

