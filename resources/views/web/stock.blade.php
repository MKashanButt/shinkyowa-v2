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
                    @if (Request::get('make'))
                        <option selected>{{ strtoupper(Request::get('make')) }}</option>
                        @foreach ($filterOptions['make'] as $item)
                            <option value="{{ $item['name'] }}">{{ strtoupper($item['name']) }}</option>
                        @endforeach
                    @else
                        <option disabled selected>Select Make</option>
                        @foreach ($filterOptions['make'] as $item)
                            <option value="{{ $item['name'] }}">{{ strtoupper($item['name']) }}</option>
                        @endforeach
                    @endif
                </select>
                <select name=" model" id="filtermodel">
                    @if (Request::get('model'))
                        <option selected>{{ strtoupper(Request::get('model')) }}</option>
                        @foreach ($filterOptions['model'] as $item)
                            <option value="{{ $item['name'] }}">{{ strtoupper($item['name']) }}</option>
                        @endforeach
                    @else
                        <option disabled selected>Select Model</option>
                        @foreach ($filterOptions['model'] as $item)
                            <option value="{{ $item['model'] }}">{{ strtoupper($item['model']) }}</option>
                        @endforeach
                    @endif
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
                    @if (Request::get('yearfrom'))
                        <option selected>{{ Request::get('yearfrom') }}</option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}">{{ strtoupper($item['year']) }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected>Year From</option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}">{{ strtoupper($item['year']) }}</option>
                        @endforeach
                    @endif
                </select>
                <select name="yearto" id="yearto">
                    @if (Request::get('yearto'))
                        <option selected>{{ Request::get('yearto') }}</option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}">{{ strtoupper($item['year']) }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected>Year To</option>
                        @foreach ($filterOptions['year'] as $item)
                            <option value="{{ $item['year'] }}">{{ strtoupper($item['year']) }}</option>
                        @endforeach
                    @endif
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
@push('css')
    <script src="{{ asset('js/ajax.js') }}"></script>
@endpush