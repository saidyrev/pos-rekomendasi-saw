<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset ('sneat/assets/') }}"
  data-template="vertical-menu-template"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $setting->nama_kafe }} | @yield('tittle')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="{{ url($setting->path_logo) }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset ('Skydash/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('Skydash/template/js/select.dataTables.min.css') }}">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset ('sneat/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset ('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset ('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset ('sneat/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset ('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset ('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset ('sneat/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset ('sneat/assets/js/config.js') }}"></script>

    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">

    @stack('css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
            @includeIf('layouts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
            @includeIf('layouts.header')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
           @includeIf('layouts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset ('sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset ('sneat/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset ('sneat/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset ('sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script src = 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js'></script>

    {{-- Data Tables --}}
    <script src="{{ asset ('Skydash/template/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset ('Skydash/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset ('Skydash/template/js/dataTables.select.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset ('sneat/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset ('sneat/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="{{ asset ('Skydash/template/js/validator.min.js') }}"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>

   <script src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/js/main.js?id=0c91cceb5195b308a36d5ac021b16464"></script>

   <script src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/js/ui-popover.js"></script>


   <script>
    function preview(selector, temporaryFile, width = 200)  {
        $(selector).empty();
        $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
    }
  </script>

    @include('sweetalert::alert')
    @stack('scripts')
  </body>
</html>
