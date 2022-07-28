<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  dir="{{str_replace('_', '-', app()->getLocale())=='ar'?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')
    <title>{{__('app.website_name')}} | @yield('page_title',__('app.dashboard'))</title>
    @if(setting()->icon)
     <link rel="shortcut icon" href="{{setting()->icon}}" />
    @endif
    <!-- Bootstrap core CSS-->
    <link href="{{url('/assets')}}/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="{{url('/assets')}}/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{url('/assets')}}/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Custom Style-->
    <link href="{{url('/assets')}}/css/app-style.css" rel="stylesheet"/>
    @stack('css')
</head>
<body>


@include('layouts.dashboard.partials._page-loader')




<!-- Start wrapper-->
<div id="wrapper">

    <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
            @yield('content')

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



</div><!--wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{url('/assets')}}/js/jquery.min.js"></script>
<script src="{{url('/assets')}}/js/jquery.validate.min.js"></script>
<script src="{{url('/assets')}}/js/popper.min.js"></script>
<script src="{{url('/assets')}}/js/bootstrap.min.js"></script>

<!-- sidebar-menu js -->
<script src="{{url('/assets')}}/js/sidebar-menu.js"></script>

<!-- Custom scripts -->
<script src="{{url('/assets')}}/js/app-script.js"></script>

@stack('js')
</body>
</html>

