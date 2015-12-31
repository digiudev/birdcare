@extends('sb-admin.layouts.dashboard')
@section('page_heading',trans('user_profile.title'))
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
                    {!! Form::model($user, ['route' => ['user.update', $user->id], 'role'=>'form', 'id'=> 'form-user-profile']) !!}

                    <div class="form-group">
                        {!! Form::label('RNA', trans('user_profile.rna').' *') !!}
                        {!! Form::text('RNA', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', trans('user_profile.name').' *')!!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', trans('user_profile.email').' *') !!}
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('id_country', trans('user_profile.country')) !!}
                        {!! Form::select('id_country', $countries, null, ['id'=>'id_country', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('province', trans('user_profile.province')) !!}
                        {!! Form::text('province', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city', trans('user_profile.city')) !!}
                        {!! Form::text('city', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('zip', trans('user_profile.zip')) !!}
                        {!! Form::text('zip', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', trans('user_profile.address')) !!}
                        {!! Form::text('address', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', trans('user_profile.phone')) !!}
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('breeding_name', trans('user_profile.breeding_name')) !!}
                        {!! Form::text('breeding_name', null, ['class'=>'form-control']) !!}
                    </div>
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    {!! Form::submit(trans('user_profile.submit')) !!}

                    {!! Form::close() !!}
                </div>
                <div class="col-lg-6">
                    <img src="<?php echo $user->avatar ?>">
                </div>
            </div>

        </div>
    <!-- Scripts -->
    {!! Html::script('resources/views/sb-admin/js/userprofile.js') !!}
@stop