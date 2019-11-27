@extends('builder.index')

@section('content')
{{--    <div class="index-content">--}}
{{--    <div class="main">--}}
{{--        <div class="sup-title">--}}
{{--            <h1>{!! $settings['Gtitle'] !!}</h1>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Monitoring -->--}}
{{--    @if($monitoringServers)--}}
{{--        @foreach($monitoringServers as $server)--}}
{{--            <div class="row content-center monitoring">--}}
{{--                <div class="col-4 col-sm-1 p-2">--}}
{{--                    @if($server['online'])--}}
{{--                        <img src="{{ asset($server['info']['map_mod_img']) }}" width="35" title="mg_" class="float-right">--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="col-4 col-sm-4">--}}
{{--                    <small>Адрес</small>--}}
{{--                    <span class="text-secondary">{{ $server['ip'] }}<i>:</i>{{ $server['port'] }}</span>--}}
{{--                </div>--}}
{{--                <div class="col-4 col-sm-2">--}}
{{--                    <small>Онлайн</small>--}}
{{--                    <span class="text-secondary">--}}
{{--                        @if($server['online'])--}}
{{--                            {{ $server['info']['players'] }}<i>/</i>{{ $server['info']['max_players'] }}--}}
{{--                        @else--}}
{{--                            OFF--}}
{{--                        @endif--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <div class="col-sm-5 d-none d-sm-block pt-2">--}}
{{--                    @if($server['online'])--}}
{{--                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server-info{{ $server['id'] }}">--}}
{{--                            <i class="fas fa-users"></i>--}}
{{--                        </button>--}}
{{--                        <button type="button" class="btn btn-primary">Подключиться</button>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Modal -->--}}
{{--            @if($server['online'])--}}
{{--                <div class="modal fade" id="server-info{{ $server['id'] }}" tabindex="-1" role="dialog" aria-labelledby="server_info_title" aria-hidden="true">--}}
{{--                    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h5 class="modal-title" id="server_info_title">{{ $server['name'] }}</h5>--}}
{{--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                @if(@isset($server['players']))--}}
{{--                                    <table class="table">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th scope="col">Username</th>--}}
{{--                                            <th scope="col">Score</th>--}}
{{--                                            <th scope="col">Playtime</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                            @foreach($server['players'] as $player)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{ $player['name'] }}</td>--}}
{{--                                                    <td>{{ $player['score'] }}</td>--}}
{{--                                                    <td>{{ $player['time'] }}</td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                @else--}}
{{--                                    There is no player on the server--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    @else--}}
{{--        <center class="text-white">Servers not found!</center>--}}
{{--    @endif--}}
{{--</div>--}}

<div class="slides">
    <section id="main">
        <div class="index-block">
            <div class="left-content">
                <div class="project-name-title">
                    <div class="sup-title">
                        <h1>{!! $settings['Gtitle'] !!}</h1>
                        <div class="title-decoration">
                            <img src="{{ asset('img/particle/default-01.png') }}">
                            <img src="{{ asset('img/particle/purple-02.png') }}">
                            <img src="{{ asset('img/particle/default-03.png') }}">
                            <img src="{{ asset('img/particle/purple-04.png') }}">
                        </div>
                        <p>SGWC - проект который базируется на разработке CMS системы (веб конструктора) для игровых серверов на движке Source. Для администатора будет возможность настроить веб-сайт под свой проект, при этом не имея знаний в программировании или вестке. </p>
                    </div>
                </div>
                <div class="servers-list">
                        <div class="server-block">
                            <div class="donut-chart">
                                <svg viewBox="0 0 42 42">
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#232323" stroke-width="3"></circle>
                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="url(#chart-gradient)" filter="url(#chart-blur)" stroke-width="4" stroke-linecap="round" stroke-dasharray="73 27" stroke-dashoffset="25"></circle>
                                    <circle class="donut-hole" cx="21" cy="21" r="14" fill="rgba(0,0,0,0)" filter="url(#chart-blur)"></circle>
                                </svg>
                                <div class="donut-text">
                                    13/24
                                </div>
                            </div>
                            <div class="donut-description">
                                <img src="{{ asset('img/game_type/dz.png') }}" title="mg_" class="server-image">
                                |KTM| Minigame Server
                            </div>
                        </div>
                    @foreach($monitoringServers as $server)
                        <div class="server-block" data-id="{{ $server['id'] }}" data-description="{{ $server['name'] }}"></div>
                    @endforeach
                </div>
            </div>
            <div class="right-content">
                test
            </div>


        </div>
    </section>
    <section id="french"><span>Bonjour</span></section>
    <section id="spanish" ><span>Hola</span></section>
    <section id="hindi"><span>Namaste</span></section>
    <section id="mandarin"><span>你好</span></section>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
@endsection

@section('javascript')
    <script type="text/javascript">
        const monitoringURL = '{{ route('helper.monitoring') }}';
        const monitoringServers = JSON.parse('{!! $monitoringServersJson !!}');
    </script>
    <script type="text/javascript" src="{{ asset('js/slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
@endsection
