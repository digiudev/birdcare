@extends('sb-admin.layouts.dashboard')
@section('page_heading','User Profile')
@section('section')
<div>

    {!! Form::model($user, array('route' => array('user.update', $user->id))) !!}

        <!-- name -->
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name') !!}

        <!-- email -->
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email') !!}

{!! Form::submit('Update Nerd!') !!}

{!! Form::close() !!}
<!-- /.col-lg-4 -->
</div>
@stop