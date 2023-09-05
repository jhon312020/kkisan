@include('layouts.includes.userheader')
<div style="position:relative; overflow: hidden;">
  @include('sweetalert::alert')
   <div class="content-wrapper">
    <main class="main-content">
      @yield('usercontent')
    </main>
  </div>
</div>
@show
@stack('scripts')
@include('layouts.includes.footer')