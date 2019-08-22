@extends('builder.index')

@section('content')
    <div class="main">
        <div class="sup-title">
            <h1>{!! $settings['Gtitle'] !!}</h1>
        </div>
    </div>

    <!-- Monitoring -->
    @if($servers != null)
        @foreach($servers as $server)
            <div class="row content-center monitoring">
                <div class="col-4 col-sm-1 p-2">
                    @if($server['online'])
                        <img src="{{ asset($server['info']['map_mod_img']) }}" width="35" title="mg_" class="float-right">
                    @endif
                </div>
                <div class="col-4 col-sm-4">
                    <small>Адрес</small>
                    <span class="text-secondary">{{ $server['ip'] }}<i>:</i>{{ $server['port'] }}</span>
                </div>
                <div class="col-4 col-sm-2">
                    <small>Онлайн</small>
                    <span class="text-secondary">
                        @if($server['online'])
                            {{ $server['info']['players'] }}<i>/</i>{{ $server['info']['max_players'] }}
                        @else
                            OFF
                        @endif
                    </span>
                </div>
                <div class="col-sm-5 d-none d-sm-block pt-2">
                    @if($server['online'])
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server-info{{ $server['id'] }}">
                            <i class="fas fa-users"></i>
                        </button>
                        <button type="button" class="btn btn-primary">Подключиться</button>
                    @endif
                </div>
            </div>
            <!-- Modal -->
            @if($server['online'])
                <div class="modal fade" id="server-info{{ $server['id'] }}" tabindex="-1" role="dialog" aria-labelledby="server_info_title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="server_info_title">{{ $server['info']['hostname'] }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(@isset($server['players']))
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Score</th>
                                            <th scope="col">Playtime</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($server['players'] as $player)
                                                <tr>
                                                    <td>{{ $player['name'] }}</td>
                                                    <td>{{ $player['score'] }}</td>
                                                    <td>{{ $player['time'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    There is no player on the server
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <center class="text-white">Servers not found!</center>
    @endif
@endsection
