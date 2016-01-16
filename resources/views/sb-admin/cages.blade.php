@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('cages.title'))
@section('section')

    {!! Html::style('resources/views/sb-admin/bower_components/datatables-1.10/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-editor/css/editor.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Buttons-1.1.0/css/buttons.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Select-1.1.0/css/select.dataTables.min.css') !!}
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cages.title_box_table')}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>

                            <table class="table table-bordered table-hover order-column" id="tbl_cages" width="100%">
                                <thead>
                                <tr>
                                    <th>{{ trans('cages.name')}}</th>
                                    <th>{{ trans('cages.area_name')}}</th>
                                    <th>{{ trans('cages.position_name')}}</th>
                                </tr>
                                </thead>
                                {{--}}<tbody>

                                @foreach ($list as $cage)
                                    <tr>
                                        <td>{{$cage->name}}</td>
                                        <td>{{$cage->area_name}}</td>
                                    </tr>
                                @endforeach

                                </tbody>--}}
                            </table>
                            <input type="hidden" id="_token" value="{{ csrf_token()}}" />
                            @include('sb-admin.incl.dataTablesScript')
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    {!! Html::script('resources/views/sb-admin/bower_components/datatables-1.10/js/jquery.dataTables.min.js') !!}
    {!! Html::script('resources/views/sb-admin/bower_components/datatables-1.10/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('resources/views/sb-admin/bower_components/Buttons-1.1.0/js/dataTables.buttons.min.js') !!}
    {!! Html::script('resources/views/sb-admin/bower_components/Select-1.1.0/js/dataTables.select.min.js') !!}
    {!! Html::script('resources/views/sb-admin/bower_components/datatables-editor/js/dataTables.editor.min.js') !!}
    {!! Html::script('resources/views/sb-admin/js/cages.js') !!}
@stop