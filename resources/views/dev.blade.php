@extends('base')

@section('content')

    @include('plugin_modules.shop')
    @include('plugin_modules.levelranks')
    @include('plugin_modules.lk_1mpulse')
    @include('plugin_modules.sourcebans')

    <div class="blockcontent-grid">
        @yield('levelranks-userdata')
        @yield('lk-userdata')
    </div>
    <div class="blockcontent-grid">
        @yield('sourcebans')
    </div>

    @yield('shop-inventory')


@endsection

