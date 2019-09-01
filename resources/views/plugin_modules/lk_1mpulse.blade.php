@section('lk-userdata')
    @if($plugin_user_data['lk_1mpulse']['userdata'] != null)
        <style>
            .info-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 10px;
                margin-bottom: 10px;
            }

            .info-grid > div {
                display: block;
                padding: 10px;
                background: rgba(255, 255, 255, 0.05);
                border: var(--block-border, 1px) solid #fff;
                text-decoration: none;
                text-align: center;
            }

            table.lk {
                width: 100%;
            }

            table.lk thead {
                color: #b39ddb;
                border-bottom: 3px #5446a9 solid;
            }

            table.lk td {
                /*background: rgba(255, 255, 255, 0.05);*/
            }

            .money {
                font-size: 2em;
            }

            .donate-box {
                height: 100%;
                font-size: 1.3em;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .donate:hover {
                background: rgba(255, 255, 255, 0.1);
                transition: 500ms;
            }

            .donate:hover > .donate-box {
                color: #b39ddb;
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
            <h3 class="blockcontent-title">[LK] Info</h3>
            <div class="info-grid">
               <div>
                   <div>Balance:</div>
                   <span class="money"><strong>{{ $plugin_user_data['lk_1mpulse']['userdata']->cash }}</strong></span>rub
               </div>
                <div>
                    <div>Total Donation:</div>
                    <span class="money">{{ $plugin_user_data['lk_1mpulse']['userdata']->all_cash }}</span>rub
                </div>
               <div class="donate">
                   <a class="donate-box" href="#">
                       <span>Donate <i class="fas fa-donate fa-lg"></i></span>
                   </a>
               </div>
            </div>
            <table class="lk">
                <thead>
                    <tr>
                        <td>Num Order</td>
                        <td>Summ</td>
                        <td>Data</td>
                        <td>Pay System</td>
                    </tr>
                </thead>
                @foreach($plugin_user_data['lk_1mpulse']['pays'] as $pay)
                <tr>
                    <td>{{ $pay->pay_order }}</td>
                    <td>{{ $pay->pay_summ }} RUB</td>
                    <td>{{ $pay->pay_data }}</td>
                    <td>{{ $pay->pay_system }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection
