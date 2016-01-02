@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('breeders.title'))
@section('section')

    {!! Html::style('resources/views/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.css') !!}
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('breeders.title_box_table')}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>

                            <table class="table table-bordered table-hover order-column" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>{{ trans('breeders.col_name')}}</th>
                                    <th>{{ trans('breeders.col_rna')}}</th>
                                    <th>{{ trans('breeders.col_breeder')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($list as $user)
                                        <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->RNA}}</td>
                                        <td>{{$user->breeding_name}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Scripts -->
{{--
    {!! Html::script('resources/views/sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('resources/views/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js') !!}
    --}}
@stop