@extends('base')

@section('content')


    @foreach($plugin_params as $params)
         @include('plugin_modules.'.$params['template'] )
    @endforeach

    <div class="blockcontent-grid">
        @yield('levelranks-userdata')
        @yield('lk-userdata')
    </div>
    @yield('sourcebans')
    @yield('shop-inventory')


@endsection

