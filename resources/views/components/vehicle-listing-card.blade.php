<a href="/vehicle-info/{{ $id }}">
    <div class="item flex">
        <img src="{{ env('STOCK_IMG_LINK') . $img }}" alt="">
        <div class="content">
            <h3>{{ strtoupper($year) }} {{ strtoupper($make) }} {{ strtoupper($model) }}</h3>
            <div class="text">
                <p>Chassis: <span>{{ $chassis }}</span></p>
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