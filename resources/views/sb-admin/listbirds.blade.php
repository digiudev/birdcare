@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('birds.title'))
@section('section')

    {!! Html::style('resources/views/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.css') !!}
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('birds.title_box_table')}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>
                            <table class="table table-bordered table-hover order-column" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>{{ trans('birds.col_rna')}}</th>
                                    <th>{{ trans('birds.col_sex')}}</th>
                                    <th>{{ trans('birds.col_specie')}}</th>
                                    <th>{{ trans('birds.col_padre')}}</th>
                                    <th>{{ trans('birds.col_madre')}}</th>
                                    <th>{{ trans('birds.col_cage')}}</th>
                                    <th>{{ trans('birds.col_dateborn')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($list as $birds)
                                        <tr>
                                        <td>{{$birds->number}}</td>
                                        <td>{{$birds->sex}}</td>
                                            <td>{{$birds->id_specie}}</td>
                                            <td>{{$birds->rna_padre}}</td>
                                            <td>{{$birds->rna_madre}}</td>
                                            <td>{{$birds->id_cage}}</td>
                                            <td>{{$birds->date_born}}</td>
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
        </div>
@stop