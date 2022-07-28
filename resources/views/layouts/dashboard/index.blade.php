<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <title>{{__('app.website_name')}} | @yield('page_title',__('app.dashboard'))</title>

    <link rel="shortcut icon" href="{{url('/assets')}}/images/logo-icon.png" />
    <!-- Vector CSS -->
    <link href="{{url('/assets')}}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <link href="{{url('/assets')}}/plugins/fancybox/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>

    <!-- simplebar CSS-->
    <link href="{{url('/assets')}}/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{url('/assets')}}/css/bootstrap.min.css" rel="stylesheet"/>
    <!--Data Tables -->
    <link href="{{url('/assets')}}/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/assets')}}/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!-- animate CSS-->
    <link href="{{url('/assets')}}/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{url('/assets')}}/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{url('/assets')}}/css/sidebar-menu.css" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{url('/assets')}}/css/app-style.css" rel="stylesheet"/>
    <!-- skins CSS-->
    <link href="{{url('/assets')}}/css/skins.css" rel="stylesheet"/>
    @stack('css')
</head>

<body>



@include('layouts.dashboard.partials._page-loader')

<!--[html-partial:include:{"file":""}]/-->
@include('layouts.dashboard.layout')


<!-- Bootstrap core JavaScript-->
<script src="{{url('/assets')}}/js/jquery.min.js"></script>
<script src="{{url('/assets')}}/js/jquery.validate.min.js"></script>
<script src="{{url('/assets')}}/js/popper.min.js"></script>
<script src="{{url('/assets')}}/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="{{url('/assets')}}/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="{{url('/assets')}}/js/sidebar-menu.js"></script>
<!-- loader scripts -->
{{--<script src="{{url('/assets')}}/js/jquery.loading-indicator.js"></script>--}}
<!-- Custom scripts -->
<script src="{{url('/assets')}}/js/app-script.js"></script>

<!--Data Tables js-->
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/jszip.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
<script src="{{url('/assets')}}/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
<!-- Chart js -->

<script src="{{url('/assets')}}/plugins/Chart.js/Chart.min.js"></script>
<!-- Vector map JavaScript -->
<script src="{{url('/assets')}}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{url('/assets')}}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Easy Pie Chart JS -->
<script src="{{url('/assets')}}/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<!-- Sparkline JS -->
<script src="{{url('/assets')}}/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{url('/assets')}}/plugins/jquery-knob/excanvas.js"></script>
<script src="{{url('/assets')}}/plugins/jquery-knob/jquery.knob.js"></script>
<script src="{{url('/assets')}}/js/crud-ajax.js"></script>
<script src="{{url('/assets')}}/plugins/alerts-boxes/js/sweetalert.min.js"></script>
<script src="{{url('/assets')}}/plugins/alerts-boxes/js/sweet-alert-script.js"></script>
<!--Light-box-->
<script src="{{url('/assets')}}/plugins/fancybox/js/jquery.fancybox.min.js"></script>
<!-- Index js -->
<script src="{{url('/assets')}}/js/index.js"></script>
<script>
    var app_url = "{{url('/')}}";
    $(function() {
        $(".knob").knob();
    });
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
        } );

        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );

    } );
</script>

@stack('js')
@yield('scripts')

</body>
</html>

