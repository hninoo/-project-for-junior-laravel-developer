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

  <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.datatable.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"> -->

</head>

<body>
  
<div class="container-scroller" style="margin-left: 300px;">
     
 
           <div class="main-panel">
              <div class="content-wrapper">
                 
                 @yield('leave')
                
              </div>
            </div>
      

  
</div>

  


    

   


  <script src="{{ asset('template/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template/js/misc.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('template/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>