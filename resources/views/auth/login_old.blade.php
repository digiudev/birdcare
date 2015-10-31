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
    @if (Auth::guest())
    <!-- strat-contact-form -->
    <div class="contact-form">
        <!-- start-form -->
        {!! Form::open(['url' => 'auth/login', 'class' => 'contact_form']) !!}
            <h1>Login Into Your Account</h1>
            <ul>
                <li>
                    <?php echo Form::email('email', '', $attributes = ['placeholder'=>'example@email.com', 'class'=>'textbox1']); ?>
                    <span class="form_hint">Enter a valid email</span>
                    <p><img src="{{VIEW_PATH}}images/contact.png" alt=""></p>
                </li>
                <li>
                    <?php echo Form::password('password', '', $attributes = ['placeholder'=>'password', 'class'=>'textbox2']); ?>
                    <span class="form_hint">Enter a password</span>
                    <p><img src="{{VIEW_PATH}}images/lock.png" alt=""></p>
                </li>
            </ul>
            <?php echo Form::submit('Sign In'); ?>
            <div class="clear"></div>
            <label class="checkbox">
                <?php echo Form::checkbox('checkbox', '', true);?>
                <i></i>Remember me
            </label>
            <div class="forgot">
                <a href="#">forgot password?</a>
            </div>
            <div class="clear"></div>
        {!! Form::close() !!}
        <!-- end-form -->
        <!-- start-account -->
        <div class="account">
            <h2><a href="#">Don' have an account? Sign Up!</a></h2>
            <div class="span"><a href="#"><img src="{{VIEW_PATH}}images/facebook.png" alt=""/><i>Sign In with Facebook</i><div class="clear"></div></a></div>
            <div class="span1"><a href="#"><img src="{{VIEW_PATH}}images/twitter.png" alt=""/><i>Sign In with Twitter</i><div class="clear"></div></a></div>
            <div class="span2"><a href="#"><img src="{{VIEW_PATH}}images/gplus.png" alt=""/><i>Sign In with Google+</i><div class="clear"></div></a></div>
        </div>
        <!-- end-account -->
        <div class="clear"></div>
        @else
            Loggatooo!!
        @endif
    </div>
    <!-- end-contact-form -->
    <div class="footer">
        <p>Bird <a href="{{URL_SITO}}">Beta</a></p>
    </div>
</div>
</body>
</html>*}}