<!DOCTYPE HTML>
<html>
<head>
    <title>Login | BirdBeta</title>
    <link href="{{VIEW_PATH}}css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="wrap">
    {{ Form::open(array('url' => 'auth/register', 'class'=>'form-registration', 'id'=>'registrationForm')) }}
    <div class="form-group {{ Form::hasError('email')?'has-errors':'' }}">
        {{ Form::label('email', 'E-Mail address', array('class'=>'control-label')) }}
        {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email address', 'required', 'autofocus')) }}
        {{ Form::error('email') }}
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Name', array('class'=>'control-label')) }}
        {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name', 'required')) }}
        {{ Form::error('name') }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password', array('class'=>'control-label')) }}
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'required')) }}
        {{ Form::error('password') }}
    </div>
    <div class="form-group">
        {{ Form::label('repeat_password', 'Repeat password', array('class'=>'control-label')) }}
        {{ Form::password('repeat_password', array('class'=>'form-control', 'placeholder'=>'Repeat password', 'required')) }}
        {{ Form::error('repeat_password') }}
    </div>
    {{ Form::button('Register', array('class'=>'btn btn-lg btn-primary btn-block', 'type'=>'submit')) }}
    {{ Form::close() }}
        </div>
        <!-- end-contact-form -->
        <div class="footer">
            <p>Bird <a href="{{URL_SITO}}">Beta</a></p>
        </div>
</div>
</body>
</html>