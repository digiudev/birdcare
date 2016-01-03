@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('areas.title'))
@section('section')

    {!! Html::style('resources/views/sb-admin/bower_components/datatables-1.10/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-1.10/css/jquery.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-editor/css/editor.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Buttons-1.1.0/css/buttons.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Select-1.1.0/css/select.dataTables.min.css') !!}
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

                            <table class="table table-bordered table-hover order-column" id="example">
                                <thead>
                                <tr>
                                    <th>{{ trans('areas.name')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($list as $area)
                                    <tr>
                                        <td>{{$area->name}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <input type="hidden" id="_token" value="{{ csrf_token()}}" />
                            <script>
                                var dataTableLabel={
                                    newRecord: "{{ trans('admin.dataTable_newRecord') }}",
                                    editRecord: "{{ trans('admin.dataTable_editRecord') }}",
                                    deleteRecord:"{{ trans('admin.dataTable_deleteRecord') }}",
                                    lengthMenu:"{{ trans('admin.dataTable_lengthMenu') }}",
                                    zeroRecords:"{{ trans('admin.dataTable_zeroRecords') }}",
                                    info:"{{ trans('admin.dataTable_info') }}",
                                    infoEmpty:"{{ trans('admin.dataTable_infoEmpty') }}",
                                    infoFiltered:"{{ trans('admin.dataTable_infoFiltered') }}",
                                    search:"{{ trans('admin.dataTable_search') }}",
                                    paginate_first:"{{ trans('admin.dataTable_paginate_first') }}",
                                    paginate_last:"{{ trans('admin.dataTable_paginate_last') }}",
                                    paginate_next:"{{ trans('admin.dataTable_paginate_next') }}",
                                    paginate_previous:"{{ trans('admin.dataTable_paginate_previous') }}"
                                };
                            </script>
                            <input type="hidden" id="txt-newbutton" value="{{ trans('admin.dataTable_newRecord') }}" />
                            <input type="hidden" id="txt-editbutton" value="{{ trans('admin.dataTable_editRecord') }}" />
                            <input type="hidden" id="txt-deletebutton" value="{{ trans('admin.dataTable_deleteRecord') }}" />
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
    {!! Html::script('resources/views/sb-admin/js/custom.js') !!}
@stop