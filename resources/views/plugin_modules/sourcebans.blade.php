@section('sourcebans')
    @isset($plugin_user_data['sourcebans'])
        <style>

            .sb-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 10px;
                margin-bottom: 10px;
            }

            .sb-grid > div {
                display: block;
                padding: 10px;
                background: rgba(255, 255, 255, 0.05);
                border: var(--block-border, 1px) solid #fff;
                text-decoration: none;
                text-align: center;
            }

            .sb-info {
                font-size: 2em;
            }

            .sb-none {
                text-align: center;
            }

            table.sourcebans {
                width: 100%;
            }

            table.sourcebans thead {
                color: #b39ddb;
                border-bottom: 3px #5446a9 solid;
            }

            table.sourcebans .banned {
                background: rgba(255, 255, 255, 0.05);
                color: red;
            }

            @media (max-width: 575.98px) {
                .sb-lenth {
                    display: none;
                }
            }
            @media (min-width: 576px) and (max-width: 767.98px) {
                .sb-lenth {
                    display: none;
                }
            }
            @media (min-width: 768px) and (max-width: 991.98px) {

            }
            @media (min-width: 992px) and (max-width: 1199.98px) {

            }
            @media (min-width: 1200px) {

            }
        </style>

        <div class="blockcontent" id="sourcebans">
            <h3 class="blockcontent-title">[SB] Bans</h3>
            <div class="sb-grid">
                <div>
                    <div>Total blocks:</div>
                    <span class="sb-info">
                        @if($plugin_user_data['sourcebans']['count_bans'] >= 20)
                            <strong>{{ $plugin_user_data['sourcebans']['count_bans'] }}</strong>
                        @else
                            {{ $plugin_user_data['sourcebans']['count_bans'] }}
                        @endif
                        /
                        @if($plugin_user_data['sourcebans']['count_comms'] >= 20)
                                <strong>{{ $plugin_user_data['sourcebans']['count_comms'] }}</strong>
                        @else
                            {{ $plugin_user_data['sourcebans']['count_comms'] }}
                        @endif
                    </span>
                </div>
                <div>
                    <div>Is banned:</div>
                    <span class="sb-info">
                        @if($plugin_user_data['sourcebans']['is_banned'])
                            <strong>Yes</strong>
                        @else
                            No
                        @endif
                    </span>
                </div>
                <div>
                    <div>Comms:</div>
                    <span class="sb-info">
                        @if($plugin_user_data['sourcebans']['is_muted'] == 1)
                            <strong>Mute</strong>
                        @elseif($plugin_user_data['sourcebans']['is_muted'] == 2)
                            <strong>Gag</strong>
                        @elseif($plugin_user_data['sourcebans']['is_muted'] == 3)
                            <strong>All</strong>
                        @else
                            No
                        @endif
                    </span>
                </div>
            </div>
            @if(count($plugin_user_data['sourcebans']['bans']))
                <table class="sourcebans">
                    <thead>
                    <tr>
                        <td>Created</td>
                        <td>Ends</td>
                        <td class="sb-lenth">Length</td>
                        <td>Reason</td>
                    </tr>
                    </thead>
                    @foreach($plugin_user_data['sourcebans']['bans'] as $ban)
                        @if($ban->ends > time())
                            <tr class="banned">
                                <td>{{ date('Y-m-d H:i:s', $ban->created) }}</td>
                                <td>{{ date('Y-m-d H:i:s', $ban->ends) }}</td>
                                <td class="sb-lenth">{{ $ban->length }}</td>
                                <td>{{ $ban->reason }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ date('Y-m-d H:i:s', $ban->created) }}</td>
                            <td>{{ date('Y-m-d H:i:s', $ban->ends) }}</td>
                            <td class="sb-lenth">{{ $ban->length }}</td>
                            <td>{{ $ban->reason }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h5 class="sb-none sub-text">You don`t have bans</h5>
            @endif
        </div>

        <script>
            if ($('#sourcebans').width() <= 430) {
                $('.sb-lenth').hide()
            }
        </script>
    @endisset
@endsection
