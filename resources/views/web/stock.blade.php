@php
    $title = 'Japanese Used Car Exporter';
    $msg = count($vehicles) == 0 ? true : false;
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/stock.css') }}">
@endpush

<x-web-layout :title="$title" :sidebar="true">
    <div class="filter">
        <h2>Filter Results</h2>
        <form action="/filter" method="get">
            <div class="row">
                <select name="make" id="filtermake">
                    <option disabled {{ Request::get('make') ? '' : 'selected' }}>Select Make</option>
                    @foreach ($filterOptions['make'] as $item)
                        <option value="{{ $item['name'] }}" {{ Request::get('make') == $item['name'] ? 'selected' : '' }}>
                            {{ strtoupper($item['name']) }}
                        </option>
                    @endforeach
                </select>
                <select name=" model" id="filtermodel">
                    <option disabled {{ Request::get('model') ? '' : 'selected' }}>Select Model</option>
                    @foreach ($filterOptions['model'] as $item)
                        <option value="{{ $item['model'] }}" {{ Request::get('model') == $item['model'] ? 'selected' : '' }}>
                            {{ strtoupper($item['model']) }}
                        </option>
                    @endforeach
                </select>
                <select name="category" id="filtercategory">
                    @if (Request::get('category'))
                        <option selected>{{ strtoupper(Request::get('category')) }}</option>
                        <option value="stock">STOCK</option>
                        <option value="new arrival">NEW ARRIVAL</option>
                        <option value="discounted">DISCOUNTED</option>
                        <option value="commercial">COMMERCIAL</option>
                    @else
                        <option value="" disabled selected>Select Category</option>
                        <option value="stock">STOCK</option>
                        <option value="new arrival">NEW ARRIVAL</option>
                        <option value="discounted">DISCOUNTED</option>
                        <option value="commercial">COMMERCIAL</option>
                    @endif
                </select>
                <select name="fueltype" id="filterfueltype">
                    @if (Request::get('fueltype'))
                        <option selected>{{ strtoupper(Request::get('fueltype')) }}</option>
                        <option value="petrol">PETROL</option>
                        <option value="diesel">DIESEL</option>
                        <option value="hybrid">HYBRID</option>
                    @else
                        <option value="" disabled selected>Select Fuel Type</option>
                        <option value="petrol">PETROL</option>
                        <option value="diesel">DIESEL</option>
                        <option value="hybrid">HYBRID</option>
                    @endif
                </select>
                <select name="transmission" id="transmission">
                    @if (Request::get('transmission'))
                        <option selected>{{ strtoupper(Request::get('transmission')) }}</option>
                        <option value="manual">MANUAL</option>
                        <option value="automatic">AUTOMATIC</option>
                    @else
                        <option value="" disabled selected>Select Transmission</option>
                        <option value="manual">MANUAL</option>
                        <option value="automatic">AUTOMATIC</option>
                    @endif
                </select>
                <select name="yearfrom" id="yearfrom">
                    <option value="" disabled {{ Request::get('yearfrom') ? '' : 'selected' }}>Year From
                    </option>
                    @foreach ($filterOptions['year'] as $item)
                        <option value="{{ $item['year'] }}" {{ Request::get('year') == $item['year'] ? 'selected' : '' }}>
                            {{ strtoupper($item['year']) }}
                        </option>
                    @endforeach
                </select>
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
            <button type="submit">Filter</button>
        </form>
    </div>
    <div class="sort-filter flex">
        <p>Total number of vehicles: <span>{{ count($vehicles) }}</span></p>
        <form action="">
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
        </form>
    </div>
    <div class="listing">
        @if ($msg)
            <p class="msg">No Vehicle Present</p>
        @endif
        @foreach ($vehicles as $item)
            <x-vehicle-listing-card :img="$item['thumbnail']" :id="$item['id']" :stockId="$item['sid']"
                :make="$item['make']['name']" :model="$item['model']" :year="$item['year']" :mileage="$item['mileage']"
                :chassis="$item['chassis']" :doors="$item['doors']" :transmission="$item['transmission']" />
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