@extends('builder.default')

@section('content')
    <div class="blockcontent">
        <div class="d-block d-sm-flex">
            <div class="d-flex d-block justify-content-center">
                <img src="{{ Auth::user()->avatar }}">
            </div>
            <div class="ml-sm-3 profile-header">
                <p class="profile-username">{{ Auth::user()->username }}</p>
                <p class="sub-text">{{ Auth::user()->realname }}</p>
                <table class="d-flex d-sm-table justify-content-center">
                    <tr>
                        <td>SteamID<strong>64</strong>: </td>
                        <td>{{ Auth::user()->steamid }}</td>
                    </tr>
                    <tr>
                        <td>SteamID<strong>32</strong>: </td>
                        <td>{{ Auth::user()->steam32 }}</td>
                    </tr>
                    <tr>
                        <td>SteamID<strong>3</strong>: </td>
                        <td>{{ Auth::user()->steam3 }}</td>
                    </tr>
                    @if($servers && count($servers) != 1)
                        <tr>
                            <td>Server List</td>
                            <td>
                                <form method="GET">
                                    <select class="custom-select" name="server" onchange='this.form.submit()'>
                                        @foreach($servers_list as $server)
                                            <option value="{{ $server->id }}" @if($server->id == $selected_server) selected @endif >{{ $server->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="blockcontent row justify-content-center">
        <div class="col-6 col-sm text-center mb-3 mb-sm-0">
            <img src="{{ asset('img/ranks/14.png') }}" alt="rank" title="rank" width="95">
        </div>
        <div class="col-6 col-sm text-center mb-3 mb-sm-0">
            <div>Shop:</div>
            <strong>23332</strong> RCC
        </div>
        <div class="col-6 col-sm text-center mb-3 mb-sm-0">
            <div>LK:</div>
            <strong>253</strong> RUB
        </div>
        <div class="col-6 col-sm text-center mb-3 mb-sm-0">
            <div>VIP:</div>
            <strong>Legendary VIP</strong>
        </div>
    </div>

    @if($plugin_user_data)
        @foreach($plugin_params as $params)
            @include('plugin_modules.'.$params['template'] )
        @endforeach

        <div class="blockcontent-grid">
            @yield('levelranks-userdata')
            @yield('lk-userdata')
        </div>
        <div class="blockcontent-grid">

        </div>
        @yield('sourcebans')
        @yield('shop-inventory')
    @endif
@endsection

@section('sidebar')
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
@endsection
