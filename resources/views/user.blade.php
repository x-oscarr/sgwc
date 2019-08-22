@extends('builder.default')

@section('content')
    @if($user != null)
        <div class="blockcontent">
            <div class="row"></div>
            <div class="d-block d-sm-flex">
                <div class="d-flex d-block justify-content-center">
                    <img src="{{ $user->avatar }}">
                </div>
                <div class="ml-sm-3 profile-header">
                    <p class="profile-username">{{ $user->username }}</p>
                    <p class="sub-text">{{ $user->realname }}</p>
                    <table class="d-flex d-sm-table justify-content-center">
                        <tr>
                            <td>SteamID<strong>64</strong>: </td>
                            <td>{{ $user->steamid }}</td>
                        </tr>
                        <tr>
                            <td>SteamID<strong>32</strong>: </td>
                            <td>{{ $user->steam32 }}</td>
                        </tr>
                        <tr>
                            <td>SteamID<strong>3</strong>: </td>
                            <td>{{ $user->steam3 }}</td>
                        </tr>
                        @if($servers && count($servers) != 1)
                            <tr>
                                <td>Server List</td>
                                <td>
                                    <form method="GET">
                                        <select class="custom-select" name="server" onchange='this.form.submit()'>
                                            @foreach($servers as $server)
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
    @else
        <center><h5>User Not Found</h5></center>
    @endif
@endsection
