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
            <h3 class="blockcontent-title">[SB] Bans</h3>
            <div class="sb-grid">
                <div>
                    <div>Total bans:</div>
                    <span class="sb-info"><strong>7548</strong></span>
                </div>
                <div>
                    <div>Status:</div>
                    <span class="sb-info"><strong>Banned</strong></span>
                </div>
            </div>
            <table class="sourcebans">
                <thead>
                <tr>
                    <td>Created</td>
                    <td>Ends</td>
                    <td>Length</td>
                    <td>Reason</td>
                </tr>
                </thead>
                @foreach($plugin_user_data['sourcebans'] as $ban)
                    @if($ban->ends > time())
                        <tr class="banned">
                            <td>{{ date('Y-m-d H:i:s', $ban->created) }}</td>
                            <td>{{ date('Y-m-d H:i:s', $ban->ends) }}</td>
                            <td>{{ $ban->length }}</td>
                            <td>{{ $ban->reason }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>{{ date('Y-m-d H:i:s', $ban->created) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $ban->ends) }}</td>
                        <td>{{ $ban->length }}</td>
                        <td>{{ $ban->reason }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endisset
@endsection
