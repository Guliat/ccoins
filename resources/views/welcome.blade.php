<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CCoins</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css" integrity="sha512-ADrqa2PY1TZtb/MoLZIZu/Z/LlPaWQeDMBV73EMwjGam43/JJ5fqW38Rq8LJOVGCDfrJeOMS3Q/wRUVzW5DkjQ==" crossorigin="anonymous" />
        <!-- Styles -->
        <style>
            html, body {
                background-color: #333;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a:hover {
                color: #929ff0;
            }
            .is-size-0 {
                font-size: 5em;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="has-text-centered">
                <div class="subtitle is-size-0 has-text-light">
                    CCoins
                </div>
                <div class="subtitle is-size-7 has-text-white">
                    by aleXandar encheW
                </div>
                

                <div class="links pt-5">
                    <a href="#">ADD TRADE</a>
                    <a href="#">ALL TRADES</a>
                    <a href="#">TRADES PER EXCHAGE</a>
                    <a href="#">TRADES PER COIN</a>
                    <a href="#">|</a>
                    <a href="#">COINS</a>
                    <a href="#">EXCHANGES</a>
                </div>
            </div>
        </div>
    </body>
</html>
