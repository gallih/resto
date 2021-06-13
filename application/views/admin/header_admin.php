<!DOCTYPE html>
<?php 
    date_default_timezone_set('Asia/Bangkok');
?>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Selamat Datang Admin</title>

    <link href="<?php echo base_url() ?>asset/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>asset/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admin/css/animate.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>asset/admin/css/dataTables.tableTools.css" rel="stylesheet">
    <!-- tabletools -->
    <link href="<?php echo base_url() ?>asset/admin/js/TableTools/media/css/TableTools.css" rel="stylesheet">


    <!-- datepicker -->
    <!-- <link href="<?php echo base_url() ?>asset/admin/datepicker/datepicker.css" rel="stylesheet"> -->
    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url() ?>asset/admin/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/admin/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?php echo base_url() ?>asset/admin/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>asset/admin/css/floatexamples.css" rel="stylesheet" type="text/css" />


    <link href="<?php echo base_url() ?>asset/admin/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url() ?>asset/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/nprogress.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap.min.js"></script>

    <!-- tabletools  dan zzero -->
   
    <!-- datepicker -->
    <script src="<?php echo base_url() ?>asset/admin/datepicker/datepicker.js"></script>    
    <script src="<?php echo base_url() ?>asset/admin/datepicker/moment.min.js"></script>    
    <!-- gauge js -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/gauge/gauge_demo.js"></script>
    <!-- chart js -->
    <script src="<?php echo base_url() ?>asset/admin/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo base_url() ?>asset/admin/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url() ?>asset/admin/js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/datepicker/daterangepicker.js"></script>
    <!-- sparkline -->
    <script src="<?php echo base_url() ?>asset/admin/js/sparkline/jquery.sparkline.min.js"></script>

    <script src="<?php echo base_url() ?>asset/admin/js/custom.js"></script>

    <!-- highcharts js -->
    <script src="<?php echo base_url() ?>asset/admin/highcharts/highcharts.js"></script>    

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/date.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/flot/jquery.flot.resize.js"></script>
     <!-- Datatables -->
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/tools/src/ZeroClipboard.js"></script>


    <!-- form validation -->
    <script src="<?php echo base_url() ?>asset/admin/js/validator/validator.js"></script>
    <!-- PNotify -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/notify/pnotify.nonblock.js"></script>
    <!-- Bootstrap file input -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/admin/js/bootstrap.file-input.js"></script>
</head>
<script type="text/javascript">
    // $(function(){
       // Find the right method, call on correct element

        // Launch fullscreen for browsers that support it!
    // })
     function launchIntoFullscreen(element) {
          if(element.requestFullscreen) {
            element.requestFullscreen();
          } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
          } else if(element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
          } else if(element.msRequestFullscreen) {
            element.msRequestFullscreen();
          }
    
        }
    $(document).ready(function(){
        $('#tes').trigger('click');
    })
</script>
<body class="nav-md" onkeyup="">
