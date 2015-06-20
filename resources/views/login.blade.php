<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Files2Cloud</title>
    <link href="/css/main.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Raleway:500,600,700|Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="header">
        <div id="header-content">
            <div id="company">
                <img src="/images/logo.png" height="40px" />
            </div>
        </div>
    </div>

    <div class="center">
        @if (count($errors) > 0)
            <div class="alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (session('message') !== null)
            <div class="alert-danger">
                <strong>Whoops!</strong> We're not sure what happened, but something went wrong. Try re-entering your credentials.<br>
            </div>
        @endif
        <div id="login">
            <h2>Log In</h2>
            <form role="form" method="POST" action="{{ url('/auth/login') }}">
                {!! csrf_field() !!}

                <div class="input-text">
                    <input class="text-box" type="text" name="username-login" placeholder="Username" />
                </div>

                <div class="input-text">
                    <input class="text-box" type="password" name="password-login" placeholder="Password" />
                </div>

                <div>
                    <button class="submit" type="submit">Log In</button>
                </div>
            </form>
        </div>
        <div id="register">
            <h2>Register</h2>
            <form role="form" method="POST" action="{{ url('/auth/register') }}">
                {!! csrf_field() !!}

                <div class="input-text">
                    <input class="text-box" type="text" name="username-register" placeholder="Username" />
                </div>

                <div class="input-text">
                    <input class="text-box"  type="password" name="password-register" placeholder="Password" />
                </div>

                <div class="submit-button">
                    <button class="submit" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
