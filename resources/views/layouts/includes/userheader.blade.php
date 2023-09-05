<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->meta_title_home}}</title>
    <link rel="icon" type="images/x-icon" href="{{ asset( $setting->favicon ) }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css" > -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

    <!-- Include Bootstrap Datepicker CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include AdminLTE JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <!-- Include Tempus Dominus CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script src="https://kit.fontawesome.com/04f89b0daf.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      /*Code to change color of active link*/
      .navbar-nav > .active > a {
          color: red; !important;
      }
    </style>
     <!-- @vite(['resources/css/app.css', 'resources/js/app.js']); -->
    
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="{{ url('/adminindex') }}" role="button"><i class="fa-solid fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ url('/userindex') }}" class="nav-link"><i class="fa-solid fa-house"></i>Home</a>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <a class="nav-link" data-widget="logout-form"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" role="button">
                <!-- <i class="fa fa-sign-out" style="font-size:48px;color:red"></i> {{ __('Logout') }} -->
                <i class="fa-solid fa-right-from-bracket"></i>{{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>

          </ul>
          </nav>


          <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="sidebar">

              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                  @if ($voter)
                  <img src="{{ url($voter->profilepic) }}" alt="" width="40" height="40" class="rounded-circle">
                  @else
                  <a href="#" class="d-block">User</a>
                  @endif
                  <h1 style="color: whitesmoke; font-size: 30px; text-transform: capitalize;"><strong>{{$voter->first_name}}</strong></h1>
                </div>
              </div>

              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item menu-open">
                  <ul class="navbar-nav">
                  <li class="nav-item active">
                  <li class="nav-item">
                    <a href="{{ route('voterAuth.edit', $voter->id) }}" class="nav-link">
                      <i class="fa-solid fa-pen-to-square"></i>
                      <p>
                         Edit
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('voterAuth.passwordedit', $voter->id) }}" class="nav-link">
                      <i class="fa-solid fa-lock"></i>
                      <p>
                         Password Edit
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('vote') }}" class="nav-link">
                      <i class="fa-solid fa-person-booth"></i>
                      <p>
                         Vote
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('polls.results') }}" class="nav-link">
                      <i class="fa-solid fa-square-poll-vertical"></i>
                      <p>
                         Ballot
                      </p>
                    </a>
                  </li>
                </li>
              </ul>
            </li>
                </ul>
              </nav>

            </div>

          </aside>
        </div>

  <script type="text/javascript">
    $(function () {
      var url = window.location;
      // for single sidebar menu
      $('ul.nav-sidebar a').filter(function () {
          return this.href == url;
      }).addClass('active');

      // for sidebar menu and treeview
      $('ul.nav-treeview a').filter(function () {
          return this.href == url;
      }).parentsUntil(".nav-sidebar > .nav-treeview")
          .css({'display': 'block'})
          .addClass('menu-open').prev('a')
          .addClass('active');
    });
  </script>
</div>