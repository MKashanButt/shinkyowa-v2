<div class="item">
    <a href="/vehicle-info/{{ $id }}">
        <img src="{{ env('STOCK_IMG_LINK') . $img }}" alt="stock-image">
        <h4>{{ strtoupper($make) }} {{ strtoupper($model) }}</h4>
        @if ($fob == 0)
            <button class="primary">Inquiry</button>
        @else
            <p>{{ $currency }} <span>{{ number_format($fob) }}</span></p>
        @endif
    </a>
</div>