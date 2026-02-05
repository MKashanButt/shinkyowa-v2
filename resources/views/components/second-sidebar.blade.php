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
                                    <x-img src="{{ env('STOCK_IMG_LINK') . $item['thumbnail'] }}"
                                        alt="vehicle-of-the-day" />
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
        <a href="/stock">
            <x-img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-one.gif' }}" />
        </a>
        <a href="/stock">
            <x-img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-two.gif' }}" />
        </a>
        <a href="/filter?yearfrom=2024">
            <x-img src="{{ env('IMAGE_API_URL') . 'images/offers/offer-three.gif' }}" />
        </a>
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