<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="../../assets/" data-template="horizontal-menu-template-no-customizer">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>@yield('title')</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />
  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('assets/js/config.js') }}"></script>
  @yield('css')
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
      <!-- Navbar -->
      @include('/layouts/nav-barjas')
      <!-- / Navbar -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Menu -->
          @include('/layouts/menu-barjas')
          <!-- / Menu -->
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              @yield('content-barjas')
            </div>
          </div>
          <!--/ Content -->
          <!-- Footer -->
          @include('/layouts/footer-barjas')
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!--/ Layout container -->
    </div>
  </div>
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  <!--/ Layout wrapper -->
  <!-- Page Loader -->
  <div class="loader"></div>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script>
    window.addEventListener("load", () => {
      const loader = document.querySelector(".loader");
      loader.classList.add("loader-hidden");
      loader.addEventListener("transitionend", () => {
        while (loader.hasChildNodes()) {
          loader.removeChild(loader.firstChild);
        }
      })
    })
  </script>
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->
  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('script')
</body>

</html>