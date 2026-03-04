@php
    $title = 'Japanese Used Car Exporter';
    $msg = count($vehicles) == 0 ? true : false;
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/stock.css') }}">
@endpush

<x-web-layout :title="$title" :sidebar="false">
    <div class="filter">
        <h2>Filter Results</h2>
        <form action="/filter" method="get">
            <div class="row">
                <div class="row-filter">
                    <label for="filtermake">Make:</label>
                    <select name="make" id="filtermake">
                        <option disabled {{ Request::get('make') ? '' : 'selected' }}>Select Make</option>
                        @foreach ($filterOptions['make'] as $item)
                            <option value="{{ $item['name'] }}" {{ Request::get('make') == $item['name'] ? 'selected' : '' }}>
                                {{ strtoupper($item['name']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row-filter">
                    <label for="filtermodel">Model:</label>
                    <select name="model" id="filtermodel">
                        <option disabled {{ Request::get('model') ? '' : 'selected' }}>Select Model</option>
                        @foreach ($filterOptions['model'] as $item)
                            <option value="{{ $item['model'] }}" {{ Request::get('model') == $item['model'] ? 'selected' : '' }}>{{ strtoupper($item['model']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row-filter">
                    <label for="bodytype">Body Type:</label>
                    <select name="bodytype" id="bodytype">
                        <option value="" disabled {{ Request::get('bodytype') ? '' : 'selected' }}>Body Type
                        </option>
                        @foreach ($filterOptions['bodytype'] as $item)
                            <option value="{{ $item['bodytype'] }}" {{ Request::get('bodytype') == $item['name'] ? 'selected' : '' }}>{{ strtoupper($item['name']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row-filter">
                    <label for="filterfueltype">Fuel Type:</label>
                    <select name="fueltype" id="filterfueltype">
                        <option value="" disabled {{ Request::get('fueltype') ? '' : 'selected' }}>Select Fuel Type
                        </option>
                        <option value="petrol" {{ Request::get('fueltype') == 'petrol' ? 'selected' : '' }}>PETROL
                        </option>
                        <option value="diesel" {{ Request::get('fueltype') == 'diesel' ? 'selected' : '' }}>DIESEL
                        </option>
                        <option value="hybrid" {{ Request::get('fueltype') == 'hybrid' ? 'selected' : '' }}>HYBRID
                        </option>
                        <option value="electric" {{ Request::get('fueltype') == 'electric' ? 'selected' : '' }}>ELECTRIC
                        </option>
                    </select>
                </div>
                <div class="row-filter">
                    <label for="transmission">Transmission:</label>
                    <select name="transmission" id="transmission">
                        <option value="" disabled {{ Request::get('transmission') ? '' : 'selected' }}>Select
                            Transmission
                        </option>
                        <option value="manual" {{ Request::get('fueltype') == 'manual' ? 'selected' : '' }}>MANUAL
                        </option>
                        <option value="automatic" {{ Request::get('fueltype') == 'automatic' ? 'selected' : '' }}>
                            AUTOMATIC
                        </option>
                    </select>
                </div>
                <div class="row-filter">
                    <label for="mileage">Mileage:</label>
                    <select name="mileage" id="mileage">
                        <option value="" disabled {{ Request::get('mileage') ? '' : 'selected' }}>Select
                            Mileage
                        </option>
                        <option value="under 50,000" {{ Request::get('mileage') == 'under 50,000' ? 'selected' : '' }}>
                            UNDER 50,000
                        </option>
                        <option value="under 100,000" {{ Request::get('mileage') == 'under 100,000' ? 'selected' : '' }}>
                            UNDER 100,000
                        </option>
                        <option value="under 100,000" {{ Request::get('mileage') == 'under 200,000' ? 'selected' : '' }}>
                            UNDER 200,000
                        </option>
                        <option value="under 300,000" {{ Request::get('mileage') == 'under 300,000' ? 'selected' : '' }}>
                            UNDER 300,000
                        </option>
                    </select>
                </div>
                <div class="row-filter">
                    <label for="yearfrom">Year From:</label>
                    <select name="yearfrom" id="yearfrom">
                        <option value="" disabled {{ Request::get('yearfrom') ? '' : 'selected' }}>Year From
                        </option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}" {{ Request::get('year') == $item['year'] ? 'selected' : '' }}>
                                {{ strtoupper($item['year']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row-filter">
                    <label for="yearto">Year To:</label>
                    <select name="yearto" id="yearto">
                        <option value="" disabled {{ Request::get('yearto') ? '' : 'selected' }}>Year To
                        </option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}" {{ Request::get('yearto') == $item['year'] ? 'selected' : '' }}>
                                {{ strtoupper($item['year']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row-filter">
                    <label for="filtercategory">Category:</label>
                    <select name="category" id="filtercategory">
                        <option value="" disabled {{ Request::get('category') ? '' : 'selected' }}>Select Category
                        </option>
                        <option value="stock" {{ Request::get('category') == 'stock' ? 'selected' : '' }}>STOCK</option>
                        <option value="new arrival" {{ Request::get('category') == 'new arrival' ? 'selected' : '' }}>NEW
                            ARRIVAL
                        </option>
                        <option value="discounted" {{ Request::get('category') == 'discounted' ? 'selected' : '' }}>
                            DISCOUNTED
                        </option>
                        <option value="commercial" {{ Request::get('category') == 'commercial' ? 'selected' : '' }}>
                            COMMERCIAL
                        </option>
                    </select>
                </div>
                <div class="row-filter">
                    <label for="country">Country:</label>
                    <select name="country" id="country">
                        <option value="" disabled {{ Request::get('country') ? '' : 'selected' }}>Country
                        </option>
                        @foreach ($filterOptions['country'] as $item)
                            <option value="{{ $item['name'] }}" {{ Request::get('country') == $item['name'] ? 'selected' : '' }}>{{ strtoupper($item['name']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit">Filter</button>
        </form>
    </div>
    <div class="sort-filter flex">
        <div>
            <p>Total number of vehicles: <span>{{ $vehicles->total() }}</span></p>
            <p>Showing: <span>{{ count($vehicles) }}</span></p>
        </div>
        <form action="">
            <div>
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort">
                    <option value="" disabled selected>Default</option>
                    <a href="/stock?sortBy=hightolow">
                        <option value="high to low">High to Low</option>
                    </a>
                    <a href="/stock?sortBy=lowtohigh">
                        <option value="low to high">Low to High</option>
                    </a>
                </select>
            </div>
        </form>
    </div>
    <div class="listing">
        @if ($msg)
            <p class="msg">No Vehicle Present</p>
        @endif
        @foreach ($vehicles as $item)
            <x-vehicle-listing-card :img="$item['thumbnail']" :id="$item['id']" :stockId="$item['sid']"
                :make="$item['make']['name']" :model="$item['model']" :year="$item['year']" :mileage="$item['mileage']"
                :chassis="$item['chassis']" :doors="$item['doors']" :transmission="$item['transmission']"
                :features="$item['features']" />
        @endforeach
    </div>
    <div class="pagination">
        @if (!$msg)
            {{ $vehicles->links('vendor.pagination.custom') }}
        @endif
    </div>
</x-web-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document
            .getElementById("filtermake")
            .addEventListener("change", function () {
                let make = this.value;
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "/get-models?make=" + make, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        let models = JSON.parse(xhr.responseText);
                        let modelDropdown = document.getElementById("filtermodel");
                        modelDropdown.innerHTML =
                            "<option disabled selected>Select Model</option>";
                        models.forEach(function (model) {
                            let option = document.createElement("option");
                            option.value = model;
                            option.text = model.toUpperCase();
                            modelDropdown.appendChild(option);
                        });
                    }
                };
                xhr.send();
            });

        document
            .getElementById("filtermodel")
            .addEventListener("change", function () {
                let model = this.value;
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "/get-years?model=" + model, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        let years = JSON.parse(xhr.responseText);
                        let yearDropdown = document.getElementById("yearfrom");
                        yearDropdown.innerHTML =
                            "<option disabled selected>Year From</option>";
                        years.forEach(function (year) {
                            let option = document.createElement("option");
                            option.value = year;
                            option.text = year;
                            yearDropdown.appendChild(option);
                        });
                    }
                };
                xhr.send();
            });
        document
            .getElementById("filtermodel")
            .addEventListener("change", function () {
                let model = this.value;
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "/get-years?model=" + model, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        let years = JSON.parse(xhr.responseText);
                        let yearDropdown = document.getElementById("yearto");
                        yearDropdown.innerHTML =
                            "<option disabled selected>Year To</option>";
                        years.forEach(function (year) {
                            let option = document.createElement("option");
                            option.value = year;
                            option.text = year;
                            yearDropdown.appendChild(option);
                        });
                    }
                };
                xhr.send();
            });
    });
</script>