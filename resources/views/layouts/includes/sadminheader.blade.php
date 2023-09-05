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

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">   -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js">

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include AdminLTE JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <!-- Include Tempus Dominus CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    <script nonce="fba6c98d-2b7b-4682-bc91-5e552f8efa25">(function(w,d){!function(di,dj,dk,dl){di[dk]=di[dk]||{};di[dk].executed=[];di.zaraz={deferred:[],listeners:[]};di.zaraz.q=[];di.zaraz._f=function(dm){return function(){var dn=Array.prototype.slice.call(arguments);di.zaraz.q.push({m:dm,a:dn})}};for(const dp of["track","set","debug"])di.zaraz[dp]=di.zaraz._f(dp);di.zaraz.init=()=>{var dq=dj.getElementsByTagName(dl)[0],dr=dj.createElement(dl),ds=dj.getElementsByTagName("title")[0];ds&&(di[dk].t=dj.getElementsByTagName("title")[0].text);di[dk].x=Math.random();di[dk].w=di.screen.width;di[dk].h=di.screen.height;di[dk].j=di.innerHeight;di[dk].e=di.innerWidth;di[dk].l=di.location.href;di[dk].r=dj.referrer;di[dk].k=di.screen.colorDepth;di[dk].n=dj.characterSet;di[dk].o=(new Date).getTimezoneOffset();if(di.dataLayer)for(const dw of Object.entries(Object.entries(dataLayer).reduce(((dx,dy)=>({...dx[1],...dy[1]})))))zaraz.set(dw[0],dw[1],{scope:"page"});di[dk].q=[];for(;di.zaraz.q.length;){const dz=di.zaraz.q.shift();di[dk].q.push(dz)}dr.defer=!0;for(const dA of[localStorage,sessionStorage])Object.keys(dA||{}).filter((dC=>dC.startsWith("_zaraz_"))).forEach((dB=>{try{di[dk]["z_"+dB.slice(7)]=JSON.parse(dA.getItem(dB))}catch{di[dk]["z_"+dB.slice(7)]=dA.getItem(dB)}}));dr.referrerPolicy="origin";dr.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(di[dk])));dq.parentNode.insertBefore(dr,dq)};["complete","interactive"].includes(dj.readyState)?zaraz.init():di.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
              <a href="{{ url('/adminindex') }}" class="nav-link"><i class="fa-solid fa-house"></i>Home</a>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a href="{{ route('users.edit', auth()->user()->id) }}" class="dropdown-item">
                  <i class="material-icons" style="font-size:15px">&#xe254;</i> Edit
                </a>
                <a class="dropdown-item" data-widget="logout-form" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button">
                   <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
          </nav>


          <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="sidebar">

              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                  <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
              </div>

              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item menu-open">
                  <ul class="navbar-nav">
                  <li class="nav-item active">
<!--                   <li class="nav-item">
                    <a href="/positionHome" class="nav-link">
                      <i class="fa-solid fa-landmark-flag"></i>
                      <p>
                         Position List
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/candidateHome" class="nav-link">
                      <i class="fa-solid fa-person"></i>
                      <p>
                         Candidate List
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/voterHome" class="nav-link">
                      <i class="fa-solid fa-users"></i>
                      <p>
                         Voter List
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/voteHome" class="nav-link">
                      <i class="fa-solid fa-check-to-slot"></i>
                      <p>
                         Vote List
                      </p>
                    </a>
                  </li> -->

                  <li class="nav-item">
                    <a href="reachus" class="nav-link">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>
                         Enquiry List
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('/adminHome') }}" class="nav-link">
                      <i class="fa-solid fa-hotel"></i>
                      <p>
                         Employee
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                      <i class="fa-solid fa-ticket"></i>
                      <p>
                         Permission
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                      <i class="fa-solid fa-unlock-keyhole"></i>
                      <p>
                         Role
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="form" class="nav-link">
                      <i class="fa-solid fa-file"></i>
                      <p>
                         Report
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/aboutHome" class="nav-link">
                      <i class="fa-solid fa-building"></i>
                      <p>
                         About
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/contactHome" class="nav-link">
                      <i class="fa-solid fa-phone"></i>
                      <p>
                         Contact
                      </p>
                    </a>
                  </li>

<!--                   <li class="nav-item">
                    <a href="/countryHome" class="nav-link">
                      <i class="fa-solid fa-globe"></i>
                      <p>
                         Country
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/languageHome" class="nav-link">
                      <i class="fa-solid fa-language"></i>
                      <p>
                         Language
                      </p>
                    </a>
                  </li> -->

                  <li class="nav-item">
                    <a href="/welcomeHome" class="nav-link">
                      <i class="fa-solid fa-door-open"></i>
                      <p>
                         Welcome
                      </p>
                    </a>
                  </li>

<!--                   <li class="nav-item">
                    <a href="/timezoneHome" class="nav-link">
                      <i class="fa-solid fa-timeline"></i>
                      <p>
                         Timezone
                      </p>
                    </a>
                  </li>

                   <li class="nav-item">
                    <a href="/currencyHome" class="nav-link">
                      <i class="fa-brands fa-gg-circle"></i>
                      <p>
                         Currency
                      </p>
                    </a>
                  </li> -->

                  <li class="nav-item">
                    <a href="/settingHome" class="nav-link">
                      <i class="fa-solid fa-gear"></i>
                      <p>
                         Setting
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/menucategoryHome" class="nav-link">
                      <i class="fa-solid fa-caret-down"></i>
                      <p>
                         MenuCategory
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/pagelayoutHome" class="nav-link">
                      <i class="fa-solid fa-table-cells-large"></i>
                      <p>
                         PageLayout
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/pageHome" class="nav-link">
                      <i class="fa-solid fa-pager"></i>
                      <p>
                         Page
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/menuHome" class="nav-link">
                      <i class="fa-solid fa-ellipsis-vertical"></i>
                      <p>
                         Menu
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/adv_locationHome" class="nav-link">
                      <i class="fa-solid fa-location-crosshairs"></i>
                      <p>
                         AdvLocation
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('under_featured_news.edit',$under->id)}}" class="nav-link">
                      <i class="fa-solid fa-newspaper"></i>
                      <p>
                         Advertisement
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/videocategoryHome" class="nav-link">
                      <i class="fa-solid fa-play"></i>
                      <p>
                         VideoCategory
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/photocategoryHome" class="nav-link">
                      <i class="fa-solid fa-photo-film"></i>
                      <p>
                         PhotoCategory
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/socialmediaHome" class="nav-link">
                      <i class="fa-solid fa-hashtag"></i>
                      <p>
                         SocialMedia
                      </p>
                    </a>
                  </li>

                   <li class="nav-item">
                    <a href="/photoHome" class="nav-link">
                      <i class="fa-solid fa-image"></i>
                      <p>
                         Photo
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/videoHome" class="nav-link">
                      <i class="fa-brands fa-youtube"></i>
                      <p>
                         Video
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