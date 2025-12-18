<a href="/vehicle-info/{{ $id }}">
    <div class="item flex">
        <img src="{{ env('STOCK_IMG_LINK') . $img }}" loading="lazy" alt="">
        <div class="content">
            <h3>{{ strtoupper($year) }} {{ strtoupper($make) }} {{ strtoupper($model) }}</h3>
            <div class="text">
                <p>Stock Id: <span>SKI-{{ str_pad($stockId, 2, 0, STR_PAD_LEFT) }}</span></p>
                <p>Chassis: <span>{{ Str::limit($chassis, 6) }}</span></p>
                <p>Year: <span>{{ $year }}</span></p>
                <p>Mileage: <span>{{ $mileage }}</span></p>
                <p>Doors: <span>{{ $doors }}</span></p>
                <p>Transmission: <span>{{ $transmission }}</span></p>
            </div>
        </div>
        <div class="action">
            <button>Get Quote</button>
        </div>
    </div>
</a>