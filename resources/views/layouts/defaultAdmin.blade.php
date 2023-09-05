<!-- @if(auth()->user()->hasRole('sadmin'))
@include('layouts.includes.sadminheader')
@elseif(auth()->user()->hasRole('admin'))
@include('layouts.includes.adminheader')  
@else -->
@include('layouts.includes.header')
<!-- @endif -->
<div style="position:relative; overflow: hidden;">
  @include('sweetalert::alert')
  <div class="content-wrapper">
    <main class="main-content">
      @yield('content')
    </main>
  </div>
</div>
<br>
@show
@stack('scripts')
@include('layouts.includes.adminfooter')