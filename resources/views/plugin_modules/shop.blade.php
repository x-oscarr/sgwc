@section('shop-inventory')
    @if(!empty($plugin_user_data['shop']['inventory']))
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
                @foreach($plugin_user_data['shop']['inventory'] as $item)
                <a href="#">
                    <img class="inventory-image" src="{{ asset($item['itemData']->picture) }}" onerror="this.src='{{ asset('img/inventory-item.png') }}'">
                    <div class="item-title text-underline">
                        <h5>{{ Str::limit($item['itemData']->name, $limit = 25, $end = '...') }}</h5>
                    </div>
                    <div>Price: <strong>{{ $item['itemData']->price }} Credits</strong></div>
                    <div>Timeleft: <strong>25d</strong> 24dh 14m</div>
                </a>
                @endforeach
            </div>
        </div>
    @endisset
@endsection
