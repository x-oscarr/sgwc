@extends('builder.default')

@section('content')
    @if($user != null)
        <div class="blockcontent">
            <div class="row"></div>
            <div class="d-block d-sm-flex">
                <div class="d-flex d-block justify-content-center">
                    <img src="{{ $user['info']->avatarFullUrl }}">
                </div>
                <div class="ml-sm-3 profile-header">
                    <p class="profile-username">
                        {{ $user['info']->personaName }}
                        @if($user['info']->personaStateId)
                            @if($user['info']->gameDetails != null)
                                <span class="badge badge-info status" data-content="{{$user['info']->gameDetails->extraInfo }}">
                                    In game
                                </span>
                            @else
                                <span class="badge badge-success status">Online</span>
                            @endif
                        @else
                            <span class="badge badge-danger status" data-content="Last logoff: {{ $user['info']->lastLogoff }}">Offline</span>
                        @endif
                    </p>
                    <p class="sub-text">{{ $user['info']->realName }}</p>
                    <table class="d-flex d-sm-table justify-content-center">
                        <tr>
                            <td>SteamID<strong>64</strong>: </td>
                            <td>{{ $user['info']->steamIds->id64 }}</td>
                        </tr>
                        <tr>
                            <td>SteamID<strong>32</strong>: </td>
                            <td>{{ $user['info']->steamIds->id32 }}</td>
                        </tr>
                        <tr>
                            <td>SteamID<strong>3</strong>: </td>
                            <td>{{ $user['info']->steamIds->id3 }}</td>
                        </tr>
                        <tr>
                            <td>Created: </td>
                            <td>{{ date('Y-m-d H:i:s', $user['info']->timecreated) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="ml-auto d-flex d-sm-block justify-content-around mt-3 mt-sm-1">
                    {{--Normal buttons--}}
                    @if($user['profile'] != null)
                        <a href="{{ route('user', ['id' => $user['profile']->id]) }}" class="btn btn-primary d-block d-sm-none d-md-inline-block"><i class="fas fa-user"></i> Profile</a>
                    @endif
                    <a href="{{ $user['info']->profileUrl }}" class="btn btn-primary d-block d-sm-none d-md-inline-block"><i class="fab fa-steam"></i> Steam</a>
                    {{--Short buttons--}}
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block d-md-none"><i class="fas fa-user"></i></a>
                    <a href="{{ $user['info']->profileUrl }}" class="btn btn-primary d-none d-sm-inline-block d-md-none"><i class="fab fa-steam"></i></a>
                </div>
            </div>
        </div>
        <div class="blockcontent">
            <h3 class="text-center">Bans</h3>
            <div class="row justify-content-center">
                <div class="col-6 col-sm text-center mb-3 mb-sm-0">
                    <div>VAC:</div>
                    <strong>{{ $user['bans']->VACBanned ? $user['bans']->NumberOfVACBans : 'none'}}</strong>
                </div>
                <div class="col-6 col-sm text-center mb-3 mb-sm-0">
                    <div>Community:</div>
                    <strong>{{ $user['bans']->CommunityBanned ? 'have' : 'none'}}</strong>
                </div>
                <div class="col-6 col-sm text-center mb-3 mb-sm-0">
                    <div>Game:</div>
                    <strong>{{ $user['bans']->NumberOfGameBans ? $user['bans']->NumberOfGameBans : 'none' }}</strong>
                </div>
                <div class="col-6 col-sm text-center mb-3 mb-sm-0">
                    <div>Economy:</div>
                    <strong>{{ $user['bans']->EconomyBan }}</strong>
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
