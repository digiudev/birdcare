@extends('sb-admin.layouts.dashboard')
@section('page_heading','User Profile')
@section('section')
    {!! Html::style('resources/views/css/sb-admin-custom.css') !!}
<div>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                console.log(navigator.geolocation);
                navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout:10000});
            } else {
                //Geolocation is not supported by this browser
            }
        }

        // handle the error here
        function positionError(error) {
            var errorCode = error.code;
            var message = error.message;

            alert(message);
        }

        function savePosition(position) {
            console.log(position);
            $.post("/admin/mylocation", {lat: position.coords.latitude, lng: position.coords.longitude, _token: "<?php echo csrf_token() ?>" });
        }
        </script>
    <button onclick="getLocation();">Get My Location</button>
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    {!! Form::model($user, array('route' => array('user.update', $user->id))) !!}
    <table class="cls_form user_profile">
        <tr>
            <td>
                <!-- RNA -->
                {!! Form::label('RNA', trans('user_profile.rna').' *') !!}
                {!! Form::text('RNA') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- name -->
                {!! Form::label('name', trans('user_profile.name').' *')!!}
                {!! Form::text('name') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- email -->
                {!! Form::label('email', trans('user_profile.email').' *') !!}
                {!! Form::email('email') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- countries -->
                {!! Form::label('id_country', trans('user_profile.country')) !!}
                {!! Form::select('id_country', $countries, null, ['id'=>'id_country']) !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- province -->
                {!! Form::label('province', trans('user_profile.province')) !!}
                {!! Form::text('province') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- city -->
                {!! Form::label('city', trans('user_profile.city')) !!}
                {!! Form::text('city') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- cap -->
                {!! Form::label('zip', trans('user_profile.zip')) !!}
                {!! Form::text('zip') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- telefono -->
                {!! Form::label('phone', trans('user_profile.phone')) !!}
                {!! Form::text('phone') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- nome_allevamento -->
                {!! Form::label('breeding_name', trans('user_profile.breeding_name')) !!}
                {!! Form::text('breeding_name') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- nome_allevamento -->
                {!! Form::label('geolocalization', trans('user_profile.geolocalization')) !!}
                {!! Form::checkbox('geolocalization') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- nome_allevamento -->
                {!! Form::label('visible', trans('user_profile.visible')) !!}
                {!! Form::checkbox('visible') !!}
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo $user->id ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
{!! Form::submit(trans('user_profile.submit')) !!}

{!! Form::close() !!}
</div>
@stop