<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Shinkyowa International exports high-quality used cars from Japan to Kenya, Tanzania, Jamaica, Bahamas, Guyana, Barbados, UK, Ireland, and Pakistan. Trustworthy service, competitive prices">
    <meta name="keywords"
        content="Japanese used cars for sale in Kenya, Used cars exported from Japan to Tanzania, Japanese car exporters in Jamaica, Second-hand Japanese cars for sale in UK, Used Japanese vehicles imported from Japan in Ireland, Japanese used cars for sale in Pakistan, Japanese vehicle exporters in the Bahamas, Japanese car imports in Guyana, Japanese auto exporters in Barbados, Used Japanese cars for sale in Kenya">

    <title>Shinkyowa International | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @stack('css')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R4DTP9C1YC"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-R4DTP9C1YC');
</script>

<body>
    <header>
        <div class="upp-header">
            <div class="container flex">
                <div class="info flex">
                    <div class="item">
                        <p>Email : <span>info@shinkyowa.com</span></p>
                    </div>
                    <div class="item">
                        <p>Phone : <span>+81 70-1524-1308, +81 70-7427-0468</span></p>
                    </div>
                    <div class="item">
                        <p>Total Stock : <span>{{ $total }}</span></p>
                    </div>
                </div>
                <div class="time">
                    <p>Japan Time : <span id="current-time"></span></p>
                </div>
                <div class="socials">
                    <a href="https://www.facebook.com/shinkyowaint" target="__blank">
                        <i class='bx bxl-facebook'></i>
                    </a>
                    <a href="https://www.linkedin.com/company/shin-kyowa-international" target="__blank">
                        <i class='bx bxl-linkedin'></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container flex">
                <div class="logo">
                    <a href="/"><img src="/logo.png" alt=""></a>
                </div>
                <div class="search">
                    <form action="/stock-search" method="get" class="flex">
                        <input type="search" name="search" id="search" placeholder="Search by Make,Mode,Year...."
                            value="{{ Request::get('search') }}">
                        <button><i class='bx bx-search'></i></button>
                    </form>
                </div>
                <div class="options flex">
                    <div class="item flex">
                        <a href="{{ route('dashboard') }}" target="__blank">
                            <p><i class='bx bxs-user'></i> <span>Login/Register</span></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <button class="hamburger" onclick="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <ul id="menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/stock">Browse Stock</a></li>
                    <li>Services
                        <ul class="submenu">
                            <li><a href="/services/shipping">Shipping</a></li>
                        </ul>
                    </li>
                    <li>About Us
                        <ul class="submenu">
                            <li><a href="/about-us/company-profile">Company Profile</a></li>
                            <li><a href="/about-us/why-choose-us">Why Choose Us</a></li>
                        </ul>
                    </li>
                    <li><a href="/sales-and-bank-details">Sales & Bank Details</a></li>
                    {{-- <li><a href="/blogs">Blogs</a></li> --}}
                    <li id="contact-us" onclick="toggleDisplay()">Contact Us</li>
                </ul>
            </div>
        </nav>
    </header>
    @if (Request::path() == '/')
        <div class="swiper mySwiper" id="slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="/stock">
                        <x-img src="{{ env('IMAGE_API_URL') . 'images/banner-one.png' }}" alt="slider-image" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="/filter?make=toyota&model=hilux&year=2024">
                        <x-img src="{{ env('IMAGE_API_URL') . 'images/banner-two.webp' }}" alt="slider-image" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="/filter?make=honda&model=crv">
                        <x-img src="{{ env('IMAGE_API_URL') . 'images/banner-three.webp' }}" alt="slider-image" />
                    </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    @endif
    <div class="content">
        @if (strpos(Request::path(), 'vehicle-info/') !== 0)
            <x-main-sidebar :make="$allmake" :count="$count" :country="$country" />
        @endif
        <div class="pageContent flex" style="gap: 10px">
            <div class="sub-content {{ $sidebar ? 'content-divide' : '' }}">
                {{ $slot }}
            </div>
            @if ($sidebar)
                <x-second-sidebar :vehicleOfDay="$vehicleOfDay" />
            @endif
        </div>
    </div>
    <footer>
        <div class="container flex">
            <div class="item">
                <img src="/logo.png" alt="">
                <p>Head office, Gunma ken Maebashi shi Komagata Machi 150-2 <br>
                    Post Code: 379-2122<br>
                    Tell & Fax: +8127 212 9973, +8127 212 9986<br>
                    Toyama office, Toyama ken Imizu shi Inazumi 786-2<br>
                    Post Code: 939-0301<br>
                    Tell & Fax: 0766 555 081<br>
                    Mon - Fri : 09am to 06pm</p>
                <p>Follow us: <a href="https://www.facebook.com/shinkyowaint" target="__blank"><i
                            class='bx bxl-facebook'></i></a>
                    <a href="https://www.linkedin.com/company/shin-kyowa-international/" target="__blank">
                        <i class='bx bxl-linkedin'></i>
                    </a>
                </p>
            </div>
            <div class="item">
                <h3>Country Stock</h3>
                <h4>African Continent</h4>
                <ul>
                    <a href="/country/Kenya">
                        <li>Kenya</li>
                    </a>
                    <a href="/country/Tanzania">
                        <li>Tanzania</li>
                    </a>
                </ul>
                <h4>Caribbean</h4>
                <ul>
                    <a href="/country/Jamaica">
                        <li>Jamaica</li>
                    </a>
                    <a href="/country/Bahamas">
                        <li>Bahamas</li>
                    </a>
                    <a href="/country/Guyana">
                        <li>Guyana</li>
                    </a>
                    <a href="/country/Barbados">
                        <li>Barbados</li>
                    </a>
                </ul>
                <h4>Europe</h4>
                <ul>
                    <a href="/country/UK">
                        <li>UK</li>
                    </a>
                    <a href="/country/Ireland">
                        <li>Ireland</li>
                    </a>
                </ul>
                <h4>Asia</h4>
                <ul>
                    <a href="/country/Pakistan">
                        <li>Pakistan</li>
                    </a>
                </ul>
            </div>
            <div class="item">
                <h3>Used Vehicles</h3>
                <ul>
                    <a href="/make/Toyota">
                        <li>Toyota</li>
                    </a>
                    <a href="/make/Nissan">
                        <li>Nissan</li>
                    </a>
                    <a href="/make/Mazda">
                        <li>Mazda</li>
                    </a>
                    <a href="/make/Mitsubishi">
                        <li>Mitsubishi</li>
                    </a>
                    <a href="/make/Honda">
                        <li>Honda</li>
                    </a>
                    <a href="/make/Suzuki">
                        <li>Suzuki</li>
                    </a>
                    <a href="/make/Subaru">
                        <li>Subaru</li>
                    </a>
                    <a href="/make/Isuzu">
                        <li>Isuzu</li>
                    </a>
                    <a href="/make/Daihatsu">
                        <li>Daihatsu</li>
                    </a>
                    <a href="/make/Mitsuoka">
                        <li>Mitsuoka</li>
                    </a>
                    <a href="/make/Lexus">
                        <li>Lexus</li>
                    </a>
                    <a href="/make/BMW">
                        <li>BMW</li>
                    </a>
                    <a href="/make/Hino">
                        <li>Hino</li>
                    </a>
                    <a href="/make/Volkswagen">
                        <li>Volkswagen</li>
                    </a>
                    <a href="/make/Mercedes">
                        <li>Mercedes</li>
                    </a>
                    <a href="/make/Audi">
                        <li>Audi</li>
                    </a>
                </ul>
            </div>
            <div class="item">
                <h3></h3>
                <ul>
                    <a href="/type/Hatchback">
                        <li>Hatchback</li>
                    </a>
                    <a href="/type/Sedan">
                        <li>Sedan</li>
                    </a>
                    <a href="/type/Sports">
                        <li>Sports</li>
                    </a>
                    <a href="/type/Sruck">
                        <li>Truck</li>
                    </a>
                    <a href="/type/Van">
                        <li>Van</li>
                    </a>
                    <a href="/type/SUV">
                        <li>SUV</li>
                    </a>
                    <a href="/type/Pickup">
                        <li>Pickup</li>
                    </a>
                    <a href="/type/Wagon">
                        <li>Wagon</li>
                    </a>
                    <a href="/type/Busses">
                        <li>Busses</li>
                    </a>
                    <a href="/type/Mini Busses">
                        <li>Mini Busses</li>
                    </a>
                </ul>
            </div>
            <div class="item">
                <h3>Other Links</h3>
                <ul>
                    <a href="/category/new arrival">
                        <li>Newly Arrived Vehicles</li>
                    </a>
                    <a href="/category/discounted">
                        <li>Discounted Vehicles</li>
                    </a>
                    <a href="/category/commercial">
                        <li>Commercial Vehicles</li>
                    </a>
                    <a href="/testimonials">
                        <li>Testimonials</li>
                    </a>
                    <a href="/sales-and-bank-details">
                        <li>Privacy Policy</li>
                    </a>
                    <a href="/stock">
                        <li>Vehicles</li>
                    </a>
                    <a href="/type/pikup">
                        <li>Pickup Trucks</li>
                    </a>
                    <li>Subscribe Newsletter</li>
                    <form action="" class="newsletter">
                        <input type="email" name="newsEmail" id="newsEmail" placeholder="Enter Email">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </form>
                </ul>
            </div>
        </div>
        <div class="container flex">
            <p>Japanese Used Cars - Shinkyowa International © Copyright 2024. All rights reserved</p>
            <p>Sitemap - Terms - Privacy Policy - Shipping Schedule - Disclaimer</p>
        </div>
    </footer>
    <a href="https://wa.me/817074270468" target="__blank">
        <button class="whatsapp">
            <i class='bx bxl-whatsapp'></i>
        </button>
    </a>
    <dialog id="contactDialog">
        <div class="message">
            <button onclick="toggleDisplay()"><i class='bx bx-x'></i></button>
            <h3>Contact Us</h3>
            <form action="" method="dialog" onsubmit="toggleDisplay()">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="10"></textarea>
                <button>Send</button>
            </form>
        </div>
    </dialog>
    @stack('js')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>