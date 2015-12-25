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
    {!! Form::model($user, array('route' => array('user.update', $user->id))) !!}
    <table class="cls_form user_profile">
        <tr>
            <td>
                <!-- RNA -->
                {!! Form::label('RNA', trans('user_profile.rna')) !!}
                {!! Form::text('RNA') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- name -->
                {!! Form::label('name', trans('user_profile.name') )!!}
                {!! Form::text('name') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- email -->
                {!! Form::label('email', trans('user_profile.email')) !!}
                {!! Form::email('email') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- countries -->
                {!! Form::label('idCountry', trans('user_profile.country')) !!}
                {!! Form::select('idCuntry', $countries, 'idCountry', ['id'=>'idCountry']) !!}
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
                {!! Form::label('cap', trans('user_profile.cap')) !!}
                {!! Form::text('cap') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- telefono -->
                {!! Form::label('telefono', trans('user_profile.phone')) !!}
                {!! Form::text('telefono') !!}
            </td>
        </tr>
        <tr>
            <td>
                <!-- nome_allevamento -->
                {!! Form::label('nome_allevamento', trans('user_profile.name_training')) !!}
                {!! Form::text('nome_allevamento') !!}
            </td>
        </tr>
    </table>
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
{!! Form::submit(trans('user_profile.submit')) !!}

{!! Form::close() !!}
</div>
@stop