<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CJFI-Accura Web Apps | @yield('title')</title>

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{url('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{url('css/animate.css')}}" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    @yield('content')

    <!-- Mainly scripts -->
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfvhGIaAAAAALKOhmq4dmICkf2ngs7p3e7oaGVA"></script>
    {{-- <script src="https://www.google.com/recaptcha/api.js?render=6LeNg2IaAAAAAK3JsKzPzc6NrBDTC9SSosk4zYVm"></script> --}}
    @yield('script')
</body>

</html>
