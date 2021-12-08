<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">	
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    @stack('css')
 
    <title>
      {{ config('app.name') }}
      @if (trim($__env->yieldContent('title')))
        &ndash;
      @endif
      @yield('title') - test
c    </title>
  </head>
  <body>
    @include('layouts.navbar')
    <div class="container mt-4">
      @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
      toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000
      }
    </script>
    @stack('js')
  </body>
</html>