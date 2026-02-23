@php
    $title = "Japanese Used Car Exporter";
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@push('js')
    <script>
        var swiper = new Swiper(".mySwiper", {
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
@endpush

<x-web-layout :title="$title" :sidebar="true">
    <div class="tabs flex">
        <div class="option">
            <p>New Arrivals</p>
        </div>
    </div>
    <div class="budget-vehicle">
        @isset ($data['New Arrival'])
            @foreach ($data['New Arrival'] as $item)
                <x-home-vehicle-card :data="$item" />
            @endforeach
            <a href="/filter?category=new arrival"><button>View All</button></a>
        @endisset
    </div>
    <div class="tabs flex">
        <div class="option">
            <p>Discounted</p>
        </div>
    </div>
    <div class="budget-vehicle">
        @isset ($data['Discounted'])
            @foreach ($data['Discounted'] as $item)
                <x-home-vehicle-card :data="$item" />
            @endforeach
            <a href="/filter?category=discounted"><button>View All</button></a>
        @endisset
    </div>
    <div class="tabs flex">
        <div class="option">
            <p>Commercial</p>
        </div>
    </div>
    <div class="budget-vehicle">
        @isset ($data['Commercial'])
            @foreach ($data['Commercial'] as $item)
                <x-home-vehicle-card :data="$item" />
            @endforeach
            <a href="/filter?category=commercial"><button>View All</button></a>
        @endisset
    </div>
    <div class="tabs flex">
        <div class="option">
            <p>All Vehicle</p>
        </div>
    </div>
    <div class="budget-vehicle">
        @isset ($data['All'])
            @foreach ($data['All'] as $item)
                <x-home-vehicle-card :data="$item" />
            @endforeach
            <a href="/filter?category=all"><button>View All</button></a>
        @endisset
    </div>
</x-web-layout>