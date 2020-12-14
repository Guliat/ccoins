<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CCoins</title>

  <!-- FAVICONS -->
  <link rel="shortcut icon" href="{{ asset('/') }}ccoins_fav32.png">
  <link rel="shortcut icon" href="{{ asset('/') }}ccoins_fav196.png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300&display=swap" rel="stylesheet">
  <!-- Styles -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}css/app.css?v=11112020" rel="stylesheet">
  <style>
      html, body {
          background-color: #fff;
          color: #636b6f;
          font-family: 'Exo 2', sans-serif;
          font-weight: 300;
          height: 100vh;
          margin: 0;
      }

      .nunito {
          font-family: Nunito;
          font-weight: 200;
      }

      .full-height {
          height: 90vh;
      }

      .flex-center {
          align-items: center;
          display: flex;
          justify-content: center;
      }

  
      .links > a {
          color: #333;
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
  </style>
  @livewireStyles
</head>