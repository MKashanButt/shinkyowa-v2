<aside class="second-sidebar">
    <div class="vehicle-of-day">
        <h2>Vehicles Of The Day</h2>
        <div class="stage">
            <div class="item">
                <div class="swiper mySwiper" id="vehicleOfDay">
                    <div class="swiper-wrapper">
                        @foreach ($vehicleOfDay as $item)
                            <div class="swiper-slide">
                                <a href="/vehicle-info/{{ $item['id'] }}">
                                    <img src="{{ env('STOCK_IMG_LINK') . $item['thumbnail'] }}" alt="vehicle-of-the-day">
                                    <p>{{ strtoupper($item['make']['name']) . ' / ' . strtoupper($item['model']) . ' ' . $item['year'] }}
                                    </p>
                                    <span>Stock No. SKI-{{ str_pad($item['sid'], 2, '0', STR_PAD_LEFT) }}</span>
                                    <a href="/vehicle-info/{{ $item['id'] }}"><button>Details</button></a>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="offers">
        <a href="/stock"><img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-one.gif' }}" alt=""></a>
        <a href="/stock"><img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-two.gif' }}" alt=""></a>
        <a href="/filter?yearfrom=2024"><img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-three.gif' }}"
                alt=""></a>
    </div>
    <hr>
</aside>
<script>
    var vehicleSwiper = new Swiper(".vehicleSwiper", {
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
    });
</script>