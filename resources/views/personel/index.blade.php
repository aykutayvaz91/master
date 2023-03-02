<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Aykut AYVAZ">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Fides Yemek Randevu Sistemi</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>
<body>
    
    @include('layouts.partials.navbar')

    <main class="container">
        @php
            if(isset($personels))
                print_r($personels);
            else if(isset($error))
                print($error);
            else
                print("hadi");
        @endphp
    </main>

    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
      
  </body>
</html>