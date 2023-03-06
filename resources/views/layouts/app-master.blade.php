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
    @yield('customcss')
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <!--<link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">-->
    <link href="{!! url('assets/datatables/datatables.min.css') !!}" rel="stylesheet">
</head>
<body>
    
  @include('layouts.partials.navbar')
  
  <main>
    <div class="container">
    <div class="col-lg justify-content-center">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              @yield('content')
            </div>
          </div>
   
      </div>
    </div>
  </main>
  <footer>
    @yield('footer')
 
  </footer>
  <script src="{!! url('assets/bootstrap/js/jquery.min.js') !!}"></script>
  <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
  <script src="{!! url('assets/datatables/datatables.min.js') !!}"></script>
  <script src="{!! url('assets/bootstrap/js/bootbox.js') !!}"></script>
  @yield('customjs')
</body>
</html>