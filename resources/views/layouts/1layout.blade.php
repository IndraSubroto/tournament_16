<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/fullcalendar/main.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5 -->
  <script src="{{ url('/') }}/admin/plugins/fullcalendar/main.min.js"></script>
  <script src="{{ url('/') }}/admin/plugins/fullcalendar-daygrid/main.min.js"></script>
  <script src="{{ url('/') }}/admin/plugins/fullcalendar-interaction/main.min.js"></script>
  <script src="{{ url('/') }}/admin/plugins/fullcalendar-bootstrap/main.min.js"></script>
  <!-- My Improve -->
  @yield('link')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  @yield('navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @yield('sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  @yield('modal')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/') }}/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ url('/') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/') }}/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/admin/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('/') }}/admin/dist/js/demo.js"></script>

@yield('script')
</body>
</html>
