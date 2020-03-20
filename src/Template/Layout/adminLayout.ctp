<!DOCTYPE html>
<html>
<head>
    <?= $this->element('admin/head'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <?= $this->element('admin/header'); ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?= $this->element('admin/aside') ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $this->fetch('content');?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   <?= $this->element('admin/footer') ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<?= $this->Html->script(['plugins/jquery/jquery.min.js',
                         'plugins/jquery-ui/jquery-ui.min.js'
                        ]) ?>
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="plugins/jquery-ui/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<?= $this->Html->script(['plugins/bootstrap/js/bootstrap.bundle.min.js',
                         'plugins/chart.js/Chart.min.js',
                         'plugins/sparklines/sparkline.js',
                         'plugins/jqvmap/jquery.vmap.min.js',
                         'plugins/jqvmap/maps/jquery.vmap.usa.js',
                         'plugins/jquery-knob/jquery.knob.min.js',
                         'plugins/moment/moment.min.js',
                         'plugins/daterangepicker/daterangepicker.js',
                         'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                         'plugins/summernote/summernote-bs4.min.js',
                         'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
                         'dist/js/adminlte.js',
                         'dist/js/pages/dashboard.js',
                         'dist/js/demo.js'
                        ]);?>
<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="plugins/moment/moment.min.js"></script> -->
<!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
</body>
</html>
