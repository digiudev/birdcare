<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>SB Admin v2.0 in Laravel 5</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- MetisMenu CSS -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'bower_components/metisMenu/dist/metisMenu.min.css') }}">

    <!-- Timeline CSS -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'dist/css/timeline.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'dist/css/sb-admin-2.css') }}">

    <!-- Morris Charts CSS -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'bower_components/morrisjs/morris.css') }}">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{ URL::asset(SBADMIN.'bower_components/font-awesome/css/font-awesome.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	{{--<link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />--}}
</head>
<body>
	@yield('body')
    <!-- jQuery -->
    <script src="{{ URL::asset(SBADMIN.'bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ URL::asset(SBADMIN.'bower_components/morrisjs/morris.min.js') }}"></script>
    <script src="{{ URL::asset(SBADMIN.'js/morris-data.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'dist/js/sb-admin-2.js') }}"></script>
	{{--<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>--}}
</body>
</html>