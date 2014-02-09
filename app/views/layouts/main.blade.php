<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication App With Laravel 4</title>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body>
    <div class="navbar navbar-static-top navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav navbar-nav">
                    @if(!Auth::check())
                        <li>{{ HTML::link('users/register', 'Register') }}</li>
                        <li>{{ HTML::link('users/login', 'Login') }}</li>
                    @else
                        <li>{{ HTML::link('users/logout', 'Logout') }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-warning">{{ Session::get('message') }}</p>
        @endif
        @yield("content")
    </div>

    {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
</body>
</html>
