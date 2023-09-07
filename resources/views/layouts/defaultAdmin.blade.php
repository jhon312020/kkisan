@include('layouts.includes.header')
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
@include('layouts.includes.footer')