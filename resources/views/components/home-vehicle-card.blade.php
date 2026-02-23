@props(['data'])

{{-- @dd($data) --}}

<div class="item">
    <a href="/vehicle-info/{{ $data['id'] }}">
        <img src="{{ env('STOCK_IMG_LINK') . $data['thumbnail'] }}" alt="stock-image" loading="lazy">
        <h4>{{ strtoupper($data['make']['name']) }} {{ strtoupper($data['model']) }}
            <span class="pill">(SKI-{{ $data['sid'] }})</span>
        </h4>
        @if ($data['fob'] == 0)
            <button class="primary">Inquiry</button>
        @else
            <p>{{ $data['currency']['symbol'] }} <span>{{ number_format($data['fob']) }}</span></p>
        @endif
    </a>
</div>