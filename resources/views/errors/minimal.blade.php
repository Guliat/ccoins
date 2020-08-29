<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 2.2rem;
                padding: 0 20px 0 20px;
                text-align: center;
            }

            .message {
                font-size: 1.4rem;
                text-align: left;
            }
            .message a {
                text-decoration: none;
                color: #636b6f;
                border: 1px solid #636b6f;
                font-size: 0.8rem;
                border-radius: 5px;
                padding: 3px 5px 1px 5px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 20px;">
                @yield('message') <br />
                <a href="{{ route('home') }}">GO HOME</a>
            </div>
        </div>
    </body>
</html>
