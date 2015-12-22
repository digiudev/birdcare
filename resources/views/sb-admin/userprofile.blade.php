@extends('sb-admin.layouts.dashboard')
@section('page_heading','User Profile')
@section('section')
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

        <!-- name -->
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name') !!}

        <!-- email -->
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email') !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
{!! Form::submit('Update Nerd!') !!}

{!! Form::close() !!}
<!-- /.col-lg-4 -->
</div>
@stop