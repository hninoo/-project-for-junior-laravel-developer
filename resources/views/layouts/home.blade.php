<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Check_in_out</title>

  <link rel="stylesheet" href="{{ asset('template/mdi/css/materialdesignicons.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('template/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
   
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('home')}}">
          <img src="images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{url('home')}}">
          <img src="" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        
        <ul class="navbar-nav navbar-nav-right">
          
          
          <li class="nav-item d-none d-xl-inline-block">

            <a class="btn btn-outline-success" href="{{url('signup')}}">
             Register  
            </a>

            <a class="btn btn-outline-success" href="{{url('signin')}}">
             Login   
            </a>

            
            
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
        
    </nav>
  </div>

    <div class="container-scroller">
         @yield('home_view')
         
    </div>


  <script src="{{ asset('template/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('template/js/vendor.bundle.addons.js') }}"></script>

  <script src="{{ asset('template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template/js/misc.js') }}"></script>
  <script src="{{ asset('template/js/dashboard.js') }}"></script>
</body>

</html>