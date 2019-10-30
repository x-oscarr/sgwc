<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> {{ $settings['Ptitle'] }} </title>
    <link rel="stylesheet" href="{{ asset('css/customization.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/builder.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700">
    @yield('css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div id="preloader" class="preloader">
    <div class="penguin"></div>
</div>

@include('builder.menu')

<div class="content">
    @yield('default_builder')
    @yield('index_builder')
</div>

<div class="particle">
    <div class="item item-circle item-anim-1"></div>
    <div class="item item-triangle item-anim-2"></div>
    <div class="item item-cross item-anim-3"></div>
    <div class="item item-circle item-anim-4"></div>
    <div class="item item-cube item-anim-5"></div>
    <div class="item item-triangle item-anim-6"></div>
    <div class="item item-cross item-anim-7"></div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/script.min.js') }}"></script>
<script src="{{ asset('js/monitoring.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/148fb0c773.js"></script>

<script>
    $(function () {
        $('.status').popover({
            container: 'body'
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('javascript')

</body>
</html>
