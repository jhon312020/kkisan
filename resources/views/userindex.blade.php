@extends('layouts.defaultUser')
@section('usercontent')
<div class="container">
  <div class="row justify-content-center">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $vote }}</h3>
                <p>Vote</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-check-to-slot"></i>
              </div>
                <a href="{{ route('polls.results') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

       <!--    <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>#</h3>
                <p>Book Return</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
        </div>
      </div> 
      <br>
      <h1>Student Details</h1>
      <div>
          <strong>Voter ID:</strong> {{ $voter->voter_id }}
      </div>

      <div>
          <strong>First Name:</strong> {{ $voter->first_name }}
      </div>

      <div>
          <strong>Last Name:</strong> {{ $voter->last_name }}
      </div>

      <div>
          <strong>Email:</strong> {{ $voter->email }}
      </div>

      <div>
          <strong>Profile Picture:</strong>
          <img src="{{ url($voter->profilepic) }}" alt="" width="100" height="100" class="rounded-circle">
      </div>
    </div>
  </div>
</div>
@endsection