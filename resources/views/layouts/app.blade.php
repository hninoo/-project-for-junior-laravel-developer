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

  <link rel="stylesheet" href="{{ asset('css/fullcalender.css') }}">
  
<script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/fullcalender.js') }}"></script>
 
  <script src="{{asset('js/moment.min.js')}}"></script>

  <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.datatable.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"> -->

</head>

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
          
          
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello,</span>

              
              {{ Auth::user()->account_name }} <span class="caret"></span></a>

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="{{url('profile')}}">
                Profile
              </a>
              
              <a class="dropdown-item" href="{{url('logout')}}">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
        
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="" alt="">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"></p>
                  <div>
                    <small class="designation text-muted"></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{url('previous_check')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Previous Check</span>
            </a>
          </li> -->
          <li class="nav-item">
            
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Leave & Late Forms</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">

                  <a class="nav-link" href="{{ url('leave_report')}}"> Leave Form</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('late_report') }}">Late Form</a>
                </li>
                
              </ul>
            </div>
           
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('requestLeave') }}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Requested Leaves</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          
           @yield('user')
         

          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->

  <!-- plugins:js -->
  <!-- <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> -->
  <!-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> -->

  <script src="{{ asset('template/js/vendor.bundle.base.js') }}"></script>
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