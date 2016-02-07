@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('birds.title'))
@section('section')

    {!! Html::style('resources/views/css/sb-admin-custom.css') !!}
    {!! Html::style('resources/views/css/jquery-confirm.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-1.10/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/datatables-editor/css/editor.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Buttons-1.1.0/css/buttons.dataTables.min.css') !!}
    {!! Html::style('resources/views/sb-admin/bower_components/Select-1.1.0/css/select.dataTables.min.css') !!}

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
                            <div class="dt-buttons">
                                <a class="dt-button buttons-create" href="{{ url ('admin/editbird') }}"><span>New</span></a>
                                <a id="button-edit" data-link="" class="dt-button buttons-selected buttons-edit disabled"><span>Edit</span></a>
                                <a id="button-delete" class="dt-button buttons-selected buttons-remove disabled confirm"><span>Delete</span></a>
                                <a id="button-couple" class="dt-button buttons-selected buttons-remove disabled"><span>Accoppia</span></a>
                            </div>

                            <table class="table table-bordered table-striped table-hover order-column" id="dataTables-birds"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>{{ trans('birds.col_rna')}}</th>
                                    <th>{{ trans('birds.col_sex')}}</th>
                                    <th>{{ trans('birds.col_specie')}}</th>
                                    <th>{{ trans('birds.col_genitori')}}</th>
                                    <th>{{ trans('birds.col_cage')}}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>{{ trans('birds.col_rna')}}</th>
                                    <th>{{ trans('birds.col_sex')}}</th>
                                    <th>{{ trans('birds.col_specie')}}</th>
                                    <th>{{ trans('birds.col_genitori')}}</th>
                                    <th>{{ trans('birds.col_cage')}}</th>
                                </tr>
                                </tfoot>
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
    <input type="hidden" id="_token" value="{{ csrf_token()}}" />
    @include('sb-admin.incl.dataTablesScript')
    {!! Html::script('resources/views/sb-admin/js/jquery-confirm.js') !!}
@stop