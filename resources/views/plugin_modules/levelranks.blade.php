@section('levelranks-userdata')
    @if($plugin_user_data['levelranks'] != null)
        <style>
            table.levelranks {
                width: 100%;
                font-size: 1.2em;
            }

            table.levelranks td {
                width: 50%
            }

            @media (max-width: 575.98px) {

            }
            @media (min-width: 576px) and (max-width: 767.98px) {

            }
            @media (min-width: 768px) and (max-width: 991.98px) {

            }
            @media (min-width: 992px) and (max-width: 1199.98px) {

            }
            @media (min-width: 1200px) {

            }
        </style>

        <div class="blockcontent">
            <h3 class="blockcontent-title">[LevelRanks] Stats</h3>
            <table class="levelranks">
                <tr>
                    <td>Playtime</td>
                    <td><strong>{{ floor($plugin_user_data['levelranks']->playtime/3600) }}</strong> h</td>
                </tr>
                <tr>
                    <td>Kills</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->kills }}</strong></td>
                </tr>
                <tr>
                    <td>Death</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->deaths }}</strong></td>
                </tr>
                <tr>
                    <td>Shots</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->shoots }}</strong></td>
                </tr>
                <tr>
                    <td>Hits</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->hits }}</strong></td>
                </tr>
                <tr>
                    <td>HeadShots</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->headshots }}</strong></td>
                </tr>
                <tr>
                    <td>Assists</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->assists }}</strong></td>
                </tr>
                <tr>
                    <td>Round Win</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->round_win }}</strong></td>
                </tr>
                <tr>
                    <td>Round Lose</td>
                    <td><strong>{{ $plugin_user_data['levelranks']->round_lose }}</strong></td>
                </tr>
            </table>
        </div>
    @endif
@endsection
