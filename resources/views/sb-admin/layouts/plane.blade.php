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

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>


    <?php if (isset($validator)) {?>
            <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator !!}
    <?php } ?>
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
<!--    <script src="{{ URL::asset(SBADMIN.'bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--  <script src="{{ URL::asset(SBADMIN.'bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Scripts -->



    <?php
    if (isset($dataTable) && $dataTable) {?>
            <!-- Laravel Javascript Validation -->
    {{--<script type="text/javascript" src="{{ asset('resources/views/sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/views/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')}}"></script>
    --}}<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                language: {
                    "lengthMenu": "{{ trans('admin.dataTable_lengthMenu') }}",
                    "zeroRecords": "{{ trans('admin.dataTable_zeroRecords') }}",
                    "info": "{{ trans('admin.dataTable_info') }}",
                    "infoEmpty": "{{ trans('admin.dataTable_infoEmpty') }}",
                    "infoFiltered": "{{ trans('admin.dataTable_infoFiltered') }}",
                    "search": "{{ trans('admin.dataTable_search') }}",
                    "paginate": {
                        "first":      "{{ trans('admin.dataTable_paginate_first') }}",
                        "last":       "{{ trans('admin.dataTable_paginate_last') }}",
                        "next":       "{{ trans('admin.dataTable_paginate_next') }}",
                        "previous":   "{{ trans('admin.dataTable_paginate_previous') }}"
                    },
                }
            });
        });
    </script>
    <?php }?>

    <?php
    if (isset($customjs))
        foreach($customjs as $js){
        ?>
        <script type="text/javascript" src="{{ asset($js)}}"></script>';
    <?php } ?>
    <!-- Metis Menu Plugin JavaScript -->
    {{--<script src="{{ URL::asset(SBADMIN.'bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ URL::asset(SBADMIN.'bower_components/morrisjs/morris.min.js') }}"></script>
    <script src="{{ URL::asset(SBADMIN.'js/morris-data.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset(SBADMIN.'dist/js/sb-admin-2.js') }}"></script>
	{{--<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>--}}

    <?php if(isset($getLocation) && $getLocation===true) {?>

    <script>
        $(window).load(function() {
            UserProfile.getLocation();
        })
    </script>
    <?php } ?>

</body>
</html>