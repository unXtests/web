<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title', trans('texts.home')) | {{ getSiteTitle() }}</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://bootswatch.com/sandstone/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.min.css" rel="stylesheet">
    @section('stylesheets_default')
      <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    @show
    @stack('styles')
  </head>
  <body>
    @include('partials.menu')

    @include('partials.notifications')

    <section class="container-fluid">
      @yield('sidebar')
      @yield('content')
    </section>

    @include('partials.analytics')

    @section('javascripts_default')
      <!-- JavaScripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
      <script type="text/javascript">
        $('.selectpicker').attr('title', "{{trans('texts.select')}}");
      </script>
      <script src="{{ asset('js/app.js') }}"></script>
    @show

    @stack('scripts')
  </body>
</html>
