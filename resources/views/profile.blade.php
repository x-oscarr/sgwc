@extends('base')

@section('content')
    {{ dd($plugin_modules) }}
    <div class="blockcontent">
        <div class="d-block d-sm-flex">
            <div class="d-flex d-block justify-content-center">
                <img src="{{ Auth::user()->avatar }}">
            </div>
            <div class="ml-sm-3 profile-header">
                <p class="profile-username">{{ Auth::user()->username }}</p>
                <p>{{ Auth::user()->realname }}</p>
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
                    <tr>
                        <td>Server List</td>
                        <td>
                            <select class="custom-select">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="blockcontent row justify-content-center">
        <div class="col-6 col-sm text-center mb-3 mb-sm-0">
            <img src="{{ asset('img/ranks/2.png') }}" alt="rank" title="rank" width="95">
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
    <div class="blockcontent">

    </div>
@endsection
