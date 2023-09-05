@extends('layouts.defaultAdmin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $positionscount }}</h3>
                <p>Positions</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-landmark-flag"></i>
              </div>
                <a href="/positionHome" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $candidatescount }}</h3>
                <p>Candidates</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-person"></i>
              </div>
                <a href="/candidateHome" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $voterscount }}</h3>
                <p>Voters</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
                <a href="/voterHome" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $votescount }}</h3>
                <p>Vote</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-check-to-slot"></i>
              </div>
                <a href="/voteHome" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

          <canvas id="voteChart"></canvas>

          <script>
              var chartData = {!! json_encode($chartData) !!};

              var ctx = document.getElementById('voteChart').getContext('2d');
              new Chart(ctx, {
                  type: 'bar',
                  data: chartData,
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true,
                              precision: 0
                          }
                      }
                  }
              });
          </script>
  </div>
</div>
@endsection