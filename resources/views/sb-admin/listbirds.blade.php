@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('birds.title'))
@section('section')

    {!! Html::style('resources/views/css/sb-admin-custom.css') !!}
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
                            <table class="table table-bordered table-hover order-column" id="dataTables-birds"
                                   width="100%">
                                <thead>
                                <tr>
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

    @include('sb-admin.incl.dataTablesScript')
@stop