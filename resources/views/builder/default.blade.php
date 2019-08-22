@extends('base')

@section('default_builder')
    <div class="content-grid">
        <div class="main">
            @yield('content')
        </div>
        <div class="sidebar">
            <div class="sidebar-grid">
                <a href="#">
                    <i class="fas fa-sliders-h"></i>
                    <span class="sidebar-dectription">Settings</span>
                </a>
                <a href="#">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="sidebar-dectription">My reports</span>
                </a>
                <a href="#">
                    <i class="fas fa-ban"></i>
                    <span class="sidebar-dectription">Punishments</span>
                </a>
                <a href="#">
                    <div class="progress position-relative">
                        <div style="position:absolute; left: 10px; color: #000">|KTM| Minigame</div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
