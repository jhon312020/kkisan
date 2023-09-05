@include('layouts.includes.appheader') 
  @include('sweetalert::alert')
    <main class="main-content" style="display: flex; background-color: green; min-height: 100vh; padding: 10px;">   
      @yield('content')
    </main>
@show
@stack('scripts')
@include('layouts.includes.footer')