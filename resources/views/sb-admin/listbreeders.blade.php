@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('breeders.title'))
@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('breeders.title_box_table')}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="dataTables-example_length">
                                        <label>{{ trans('breeders.number_shows')}} <select
                                                    name="dataTables-example_length" aria-controls="dataTables-example"
                                                    class="form-control input-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                        <label>{{ trans('breeders.search')}}<input type="search"
                                                                                   class="form-control input-sm"
                                                                                   placeholder=""
                                                                                   aria-controls="dataTables-example"></label>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>{{ trans('breeders.col_name')}}</th>
                                    <th>{{ trans('breeders.col_rna')}}</th>
                                    <th>{{ trans('breeders.col_breeder')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeA">
                                    @foreach ($list as $user)
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->RNA}}</td>
                                        <td>{{$user->breeding_name}}</td>
                                    @endforeach
                                </tr>
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
@stop