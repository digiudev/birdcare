<!DOCTYPE html>
<html>
    <head>
        <title>Birds Beta Version 1.0</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .linkLogin a{
                color: #000000;
                font-size: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Bird Care - Beta Version</div>
                @if(auth()->guest())


                <div class="linkLogin"> <br /><br /><a href="/login?from=home">Login</a>
                    <br /><br /><a href="/register?from=home">Registrati</a></div>
                @else
                    <div class="linkLogin"> <br /><br /><a href="/admin">Area privata</a>
                @endif
            </div>
        </div>
    </body>
</html>
