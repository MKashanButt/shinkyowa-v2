@php
    $features = json_decode($vehicle['features'], true);
@endphp
@php
    $title = $vehicle['make']['name'] . ' ' . $vehicle['model'] . ' ' . $vehicle['year'];
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/vehicle-info.css') }}">
@endpush

<x-web-layout :title="$title" :sidebar="false">
    <h2>{{ strtoupper($vehicle['make']['name']) }} {{ strtoupper($vehicle['model']) }}
        {{ strtoupper($vehicle['transmission']) }}
        {{ $vehicle['year'] }}
        {{ $vehicle['fuel'] }} for Sale
    </h2>
    <div class="stage flex">
        <div class="item">
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ env('STOCK_IMG_LINK') . $vehicle['thumbnail'] }}" alt="vehicle-image"
                            class="main-image">
                    </div>
                    @foreach (explode(',', $vehicle['images']) as $image)
                        <div class="swiper-slide">
                            <img src="{{ env('STOCK_IMG_LINK') . trim($image, '[]""') }}" alt="vehicle-image"
                                class="main-image">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next swiper-btn"></div>
                <div class="swiper-button-prev swiper-btn"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ env('STOCK_IMG_LINK') . $vehicle['thumbnail'] }}" alt="vehicle-image"
                            class="main-image vehicle-image">
                    </div>
                    @foreach (explode(',', $vehicle['images']) as $image)
                        <div class="swiper-slide">
                            <img src="{{ env('STOCK_IMG_LINK') . trim($image, '[]""') }}" alt="vehicle-image"
                                class="main-image vehicle-image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="item">
            <div class="tabs">
                <button disabled><i class='bx bxs-car-garage'></i> Vehicle Details</button>
            </div>
            <div class="stage">
                <div class="vehicle-details">
                    <div class="table">
                        <div class="col flex">
                            <div class="row">
                                <p>S.No</p>
                            </div>
                            <div class="row">
                                <p>SKI-{{str_pad($vehicle['sid'], 2, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Chassis</p>
                            </div>
                            <div class="row">
                                <p>{{ $vehicle['chassis'] }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Make / Model</p>
                            </div>
                            <div class="row">
                                <p>{{ strtoupper($vehicle['make']['name']) }} / {{ strtoupper($vehicle['model']) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Year</p>
                            </div>
                            <div class="row">
                                <p>{{ $vehicle['year'] }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Body Type</p>
                            </div>
                            <div class="row">
                                <p>{{ strtoupper($vehicle['bodyType']->name) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Fuel</p>
                            </div>
                            <div class="row">
                                <p>{{ strtoupper($vehicle['fuel']) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Mileage</p>
                            </div>
                            <div class="row">
                                <p>{{ $vehicle['mileage'] }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Transmission</p>
                            </div>
                            <div class="row">
                                <p>{{ strtoupper($vehicle['transmission']) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Doors</p>
                            </div>
                            <div class="row">
                                <p>{{ $vehicle['doors'] }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Color</p>
                            </div>
                            <div class="row">
                                <p>{{ $vehicle['color'] ?? 'NA' }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>Country</p>
                            </div>
                            <div class="row">
                                <p>{{ strtoupper($vehicle['country']['name']) }}</p>
                            </div>
                        </div>
                        <div class="col flex">
                            <div class="row">
                                <p>FOB Price</p>
                            </div>
                            <div class="row">
                                @if ($vehicle['fob'] == 0)
                                    <p>Inquire</p>
                                @else
                                    <p>{{ $vehicle['currency']['symbol'] . number_format($vehicle['fob']) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="extras">
                        <h4>Features</h4>
                        <p>
                        <ul>
                            @if ($features)
                                @foreach ($features as $feature)
                                    <li>{{ strtoupper(str_replace('_', ' ', $feature)) }}</li>
                                @endforeach
                            @endif
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="action">
                    @isset($success)
                        <div class="success">
                            {{ $success }}
                        </div>
                    @endisset
                    @isset($msg)
                        <div class="inquiryCompletionMsg">
                            {{ $msg }}
                        </div>
                    @endisset
                    <form action="/send-email" method="post">
                        @csrf
                        <div class="destination">
                            <h3>Step 1: Select Vehicle Destination</h3>
                            <select name="destination" id="destination" {{ isset($msg) ? 'disabled' : '' }}>
                                <option value="" disabled selected>Select Destination</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Ireland">Ireland</option>
                                <option value="UK">UK</option>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>
                        <div class="destination">
                            <h3>Step 2: Vehicle Enquiry Form</h3>
                            <p>Enter your details below to send your enquiry for this vehicle</p>
                            <input type="text" name="stock_id" id="stock_id" placeholder="Stock Id" hidden
                                value="{{ $vehicle['sid'] }}">
                            <input type="text" name="full_name" id="full_name" placeholder="Full Name" required {{ isset($msg) ? 'disabled' : '' }}>
                            <input type="email" name="email_address" id="email" placeholder="Email Address" required {{ isset($msg) ? 'disabled' : '' }}>
                            <input type="number" name="phone_no" id="phone_no" placeholder="Phone No" {{ isset($msg) ? 'disabled' : '' }}>
                            <select name="country" id="country" required {{ isset($msg) ? 'disabled' : '' }}>
                                <option value="" disabled selected>Select Country</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Ireland">Ireland</option>
                                <option value="UK">UK</option>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                            <textarea name="comment" id="comment" cols="30" rows="10"
                                placeholder="Enter Comment or any other details you want to provide" required {{ isset($msg) ? 'disabled' : '' }}></textarea>
                        </div>
                        <div class="destination">
                            <button {{ isset($msg) ? 'disabled' : '' }}>Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <section class="modal">
        <div class="container">
            <span class="close">&times;</span>
            <img class="modal-content" id="modal-image">
        </div>
    </section>
    <script>
        const modal = document.querySelector('.modal');
        const modalImage = document.getElementById('modal-image');
        const captionText = document.querySelector('.caption');

        const images = document.querySelectorAll('.vehicle-image');

        images.forEach(image => {
            image.addEventListener('click', () => {
                modal.style.display = 'block';
                modal.style.display = 'flex';
                modalImage.src = image.src;
                // Optional: Add caption if available
                captionText.textContent = image.alt;
            });
        });

        const span = document.getElementsByClassName('close')[0];
        span.onclick = function () {
            modal.style.display = 'none';
        }
    </script>
</x-web-layout>