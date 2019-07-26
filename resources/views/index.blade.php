@extends('base')

@section('content')
    <div class="main">
        <div class="sup-title">
            <h1>KTM <span>MINI</span>GAME</h1>
        </div>
    </div>

    <!-- Monitoring -->
    <div class="row content-center monitoring">
        <div class="col-4 col-sm-1 p-2">
            <img src="{{ asset('img/game_type/mg_.png') }}" width="35" title="mg_" class="float-right">
        </div>
        <div class="col-4 col-sm-4">
            <small>Адрес</small>
            <span class="text-secondary">192.168.0.1<i>:</i>7777</span>
        </div>
        <div class="col-4 col-sm-2">
            <small>Онлайн</small>
            <span class="text-secondary">16<i>/</i>40</span>
        </div>
        <div class="col-sm-5 d-none d-sm-block pt-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server-info1">In</button>
            <button type="button" class="btn btn-primary">Подключиться</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="server-info1" tabindex="-1" role="dialog" aria-labelledby="server_info_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="server_info_title">|KTM|Minigames|!shop|!ws|!vip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Score</th>
                            <th scope="col">Playtime</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>FFFFFFFFFFFFFFFFFFFFFFFF</td>
                            <td>16</td>
                            <td>14h 23m</td>
                        </tr>
                        <tr>
                            <td>zomboy7</td>
                            <td>14</td>
                            <td>4h 23m</td>
                        </tr>
                        <tr>
                            <td>lococat</td>
                            <td>4</td>
                            <td>12h 23m</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
