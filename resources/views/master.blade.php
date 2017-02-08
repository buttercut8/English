<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('public/css/app.css')}}">
  </head>
  <body>
      @yield('content')
      <script type="text/javascript">
          function id(){
            return "{{Auth::id()}}";
          }
      </script>
      <script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
      @yield('script')
  </body>
</html>
