@extends('sb-admin.layouts.dashboard')
@if(!isset($bird))
    @section('page_heading',trans('birds.title_add'))
@else
    @section('page_heading',trans('birds.title_edit'))
@endif
@section('section')
    {!! Html::style('resources/views/css/sb-admin-custom.css') !!}
    {!! Html::style('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css') !!}


    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <div class="col-sm-12">
        <div class="row">
            @if(isset($bird))
                {!! Form::model($bird, ['route' => ['birds.update', 'id='.$bird->id], 'role'=>'form', 'id'=> 'form-bird', 'files'=>true]) !!}
            @else
                {!! $bird = null !!}
                {!! Form::open(['route' => 'birds.create',  'id'=> 'form-bird', 'files'=>true]) !!}
            @endif
                <div class="col-lg-12 upload-image-edit-bird">
                <div class="form-group">
                    @if(isset($bird) && $bird->image!='')
                        <div class="col-lg-6">
                            {!! Html::image('/uploads/'.$bird->id_user.'/birds/'.$bird->image, 'image', ['class' => 'image-bird-edit']) !!}
                        </div>
                        <div class="col-lg-6">
                    @else
                        <div class="col-lg-6">
                        {!! Form::label('image', trans('birds.form_image')) !!}
                    @endif
                    <br />
                    {!! Form::file('image') !!}
                            </div>
                </div>
                    </div>
                    <br /><br />
            <div class="col-lg-6" style="margin-top: 10px;">


                <div class="form-group">
                    {!! Form::label('number', trans('birds.form_number').' *') !!}
                    {!! Form::text('number', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_specie', trans('birds.form_specie')) !!}
                    {!! Form::text('id_specie', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_padre', trans('birds.form_padre')) !!}
                    {!! Form::text('id_padre', $dad, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_madre', trans('birds.form_madre')) !!}
                    {!! Form::text('id_madre', $mum, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sex', trans('birds.form_sex').' *')!!}
                    {!! Form::select('sex', ['M' => trans('birds.male'), 'F' => trans('birds.female')], null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_cage', trans('birds.form_cage')) !!}
                    {!! Form::select('id_cage', $cages, null, ['class'=>'form-control']) !!}
                </div>

            </div>
            <div class="col-lg-6" style="margin-top: 10px;">

                <?php
                    $dateBorn = null;
                    if(is_null($bird) || (is_object($bird) && $bird->date_born === null))
                        $dateBorn = date('d/m/Y',time());
                ?>
                <div class="form-group">
                    {!! Form::label('date_born', trans('birds.form_date_born')) !!}
                    {!! Form::text('date_born', $dateBorn, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('date_sale', trans('birds.form_date_sale')) !!}
                    {!! Form::text('date_sale', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('note', trans('birds.form_note')) !!}
                    {!! Form::textarea('note', null, ['class'=>'form-control', 'rows'=>12]) !!}
                </div>
            </div>
            @if(isset($bird))
                <input type="hidden" name="id" value="<?php echo $bird->id ?>">
            @endif
            {!! Form::submit(trans('birds.submit'), ['class'=>'btn btn-primary btn-lg btn-block']) !!}

            {!! Form::close() !!}
        </div>
        <div class="col-lg-6">
        </div>
    </div>

    </div>
    <!-- Scripts -->
    {!! Html::script('resources/views/sb-admin/js/editbird.js') !!}
    {!! Html::script('//code.jquery.com/ui/1.11.4/jquery-ui.js') !!}
@stop