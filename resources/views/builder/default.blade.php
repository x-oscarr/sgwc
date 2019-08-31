@extends('base')

@section('default_builder')
    <div class="content-grid">
        <div class="main">
            @yield('content')
        </div>
        @hasSection('sidebar')
            <div class="sidebar">
                <div class="sidebar-grid">
                    @yield('sidebar')
                </div>
            </div>
        @else
            <style>
                .content-grid {grid-template-columns: auto;}
            </style>
        @endif
    </div>
@endsection
