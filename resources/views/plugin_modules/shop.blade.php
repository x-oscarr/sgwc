@section('shop-inventory')
    @isset($plugin_user_data['shop'])
        <style>
            .inventory-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                grid-gap: 10px;
            }

            .inventory-grid > a {
                display: block;
                /*padding: .5em;*/
                background: rgba(255, 255, 255, 0.05);
                border: var(--block-border, 1px) solid #fff;
                text-decoration: none;
            }

            .inventory-grid > a:hover{
                transition: 500ms;
                background: rgba(255, 255, 255, 0.1);
            }

            .inventory-grid > a img {
                display: block;
                margin: 0 auto;
                margin-bottom: 15px;
                width: 100%;
                height: 120px;
            }

            .inventory-grid > a div {
                margin: 10px;
                overflow: hidden;
            }

            .item-title {
                text-transform: uppercase;
                text-align: center;
                margin: 0;
                min-height: 50px;
            }

            @media (max-width: 575.98px) {
                .inventory-grid {
                    grid-template-columns: 1fr;
                }
                .inventory-grid > a img {
                    height: 300px;
                }
            }
            @media (min-width: 576px) and (max-width: 767.98px) {
                .inventory-grid {
                    grid-template-columns: 1fr 1fr;
                }
                .inventory-grid > a img {
                    height: 200px;
                }
            }
            @media (min-width: 768px) and (max-width: 991.98px) {

            }
            @media (min-width: 992px) and (max-width: 1199.98px) {

            }
            @media (min-width: 1200px) {

            }
        </style>

        <div class="blockcontent">
            <h3 class="blockcontent-title">[Shop] Inventory</h3>
            <div class="inventory-grid">
                <a href="#">
                    <img src="{{ asset('img/fixture/1.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>34000 RCC</strong></div>
                    <div>Timeleft: <strong>25d</strong> 24dh 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/2.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>1456 RCC</strong></div>
                    <div>Timeleft: <strong>47d</strong> 24h 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/3.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>23 RCC</strong></div>
                    <div>Timeleft: <strong>14d</strong> 24h 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/4.png') }}">
                    <div class="item-title text-underline">
                        <h5>{{ str_limit('Greddenation Floortrash', $limit = 25, $end = '...') }}</h5>
                    </div>
                    <div>Price: <strong>37484584 RCC</strong></div>
                    <div>Timeleft: <strong>7d</strong> 24h 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/1.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>34000 RCC</strong></div>
                    <div>Timeleft: <strong>25d</strong> 24dh 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/2.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>1456 RCC</strong></div>
                    <div>Timeleft: <strong>47d</strong> 24h 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/3.jpg') }}">
                    <div class="item-title text-underline">
                        <h5>Freeker</h5>
                    </div>
                    <div>Price: <strong>23 RCC</strong></div>
                    <div>Timeleft: <strong>14d</strong> 24h 14m</div>
                </a>
                <a href="#">
                    <img src="{{ asset('img/fixture/4.png') }}">
                    <div class="item-title text-underline">
                        <h5>{{ str_limit('Greddenation Floortrash', $limit = 25, $end = '...') }}</h5>
                    </div>
                    <div>Price: <strong>37484584 RCC</strong></div>
                    <div>Timeleft: <strong>14d</strong> 24h 14m</div>
                </a>
            </div>
        </div>
    @endisset
@endsection
