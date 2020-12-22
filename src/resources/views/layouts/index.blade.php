<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body class="md-skin">
    <div id="wrapper">
        @include('layouts.menu')
        <div id="page-wrapper" class="gray-bg">
            @include('layouts.navbar')
            @include('layouts.breadcrumb')
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>
    <script src="{{ url('js/all.js') }}"></script>
    <script>
        jQuery(function(a){
            $(".module-bg").mouseenter(function() {
                $(this).addClass('yellow-bg')
            }).mouseleave(function() {
                $(this).removeClass('yellow-bg')
            });
        })
    </script>
</body>
</html>