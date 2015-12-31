@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('settings.title'))
@section('section')
    {!! Html::style('resources/views/css/sb-admin-custom.css') !!}

    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                {!! Form::model($settings, ['route' => ['user.updatesettings', $user->id], 'role'=>'form', 'id'=> 'form-user-settings']) !!}

                {!! \App\Library\DiGiuDevForm::onofswitch('localization', $settings->localization) !!}
                {!! \App\Library\DiGiuDevForm::onofswitch('visible', $settings->visible) !!}
                <input type="hidden" name="id_user" value="<?php echo $user->id ?>">
                {!! Form::submit(trans('settings.submit')) !!}

                {!! Form::close() !!}
            </div>
        </div>

    </div>
@stop