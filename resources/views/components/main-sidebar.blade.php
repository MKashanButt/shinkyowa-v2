<aside class="main-sidebar">
        <div class="search">
                <h2 class="heading">Search</h2>
                <form action="/filter" method="GET">
                        <div class="item">
                                <label for="make">Make:</label>
                                <select name="make" id="make">
                                        @if (Request::get('make'))
                                                <option disabled selected>{{ strtoupper(Request::get('make')) }}</option>
                                        @else
                                                <option disabled selected>Select Make</option>
                                        @endif
                                        @foreach ($make as $item)
                                                <option value="{{ $item['name'] }}">{{ strtoupper($item['name']) }}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="item">
                                <label for="model">Model:</label>
                                <select name="model" id="model">
                                        @if (Request::get('model'))
                                                <option disabled selected>{{ strtoupper(Request::get('model')) }}</option>
                                        @else
                                                <option disabled selected>Select Model</option>
                                        @endif
                                </select>
                        </div>
                        <div class="item">
                                <label for="stock">Stock:</label>
                                <input type="text" name="stock" id="stock" placeholder="Stock No">
                        </div>
                        <button>Search</button>
                </form>
        </div>
        <div class="make">
                <h2 class="heading">Search By Make</h2>
                <ul>
                        <li><a href="/make/Alfa Romeo"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/alfa-romeo.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Alfa Romeo({{ $count['Alfa Romeo'] }})</span></a></li>
                        <li><a href="/make/Toyota"><img src="{{ env('IMAGE_API_URL') . 'images/makes/toyota.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Toyota({{ $count['Toyota'] }})</span></a></li>
                        <li><a href="/make/Nissan"><img src="{{ env('IMAGE_API_URL') . 'images/makes/nissan.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Nissan({{ $count['Nissan'] }})</span></a></li>
                        <li><a href="/make/Mazda"><img src="{{ env('IMAGE_API_URL') . 'images/makes/mazda.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Mazda({{ $count['Mazda'] }})</span></a></li>
                        <li><a href="/make/Mitsubishi"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/mitsubishi.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Mitsubishi({{ $count['Mitsubishi'] }})</span></a></li>
                        <li><a href="/make/Honda"><img src="{{ env('IMAGE_API_URL') . 'images/makes/honda.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Honda({{ $count['Honda'] }})</span></a></li>
                        <li><a href="/make/Suzuki"><img src="{{ env('IMAGE_API_URL') . 'images/makes/suzuki.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Suzuki({{ $count['Suzuki'] }})</span></a></li>
                        <li><a href="/make/Subaru"><img src="{{ env('IMAGE_API_URL') . 'images/makes/subaru.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Subaru({{ $count['Subaru'] }})</span></a></li>
                        <li><a href="/make/Isuzu"><img src="{{ env('IMAGE_API_URL') . 'images/makes/isuzu.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Isuzu({{ $count['Isuzu'] }})</span></a></li>
                        <li><a href="/make/Daihatsu"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/daihatsu.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Daihatsu({{ $count['Daihatsu'] }})</span></a></li>
                        <li><a href="/make/Mitsuoka"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/mitsuoka.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Mitsuoka({{ $count['Mitsuoka'] }})</span></a></li>
                        <li><a href="/make/Lexus"><img src="{{ env('IMAGE_API_URL') . 'images/makes/lexus.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Lexus({{ $count['Lexus'] }})</span></a></li>
                        <li><a href="/make/BMW"><img src="{{ env('IMAGE_API_URL') . 'images/makes/BMW.avif' }}"
                                                loading="lazy" alt="">
                                        <span>BMW({{ $count['BMW'] }})</span></a></li>
                        <li><a href="/make/Mercedes"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/mercedes.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Mercedes({{ $count['Mercedes'] }})</span></a></li>
                        <li><a href="/make/Audi"><img src="{{ env('IMAGE_API_URL') . 'images/makes/audi.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Audi({{ $count['Audi'] }})</span></a></li>
                        <li><a href="/make/Hino"><img src="{{ env('IMAGE_API_URL') . 'images/makes/hino.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Hino({{ $count['Hino'] }})</span></a></li>
                        <li><a href="/make/Volkswagen"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/volkswagon.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Volkswagen({{ $count['Volkswagen'] }})</span></a></li>
                </ul>
        </div>
        <div class="type">
                <h2 class="heading">Search By Type</h2>
                <ul>
                        <li><a href="/type/Hatchback"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/type/hatchback.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Hatchback({{ $count['Hatchback'] }})</span></a></li>
                        <li><a href="/type/Sedan"><img src="{{ env('IMAGE_API_URL') . 'images/type/sedan.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Sedan({{ $count['Sedan'] }})</span></a></li>
                        <li><a href="/type/Truck"><img src="{{ env('IMAGE_API_URL') . 'images/type/truck.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Truck({{ $count['Truck'] }})</span></a></li>
                        <li><a href="/type/SUV"><img src="{{ env('IMAGE_API_URL') . 'images/type/suv.avif' }}"
                                                loading="lazy" alt="">
                                        <span>SUV({{ $count['SUV'] }})</span></a></li>
                        <li><a href="/type/Van"><img src="{{ env('IMAGE_API_URL') . 'images/type/van.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Van({{ $count['Van'] }})</span></a></li>
                        <li><a href="/type/Pickup"><img src="{{ env('IMAGE_API_URL') . 'images/type/pickup.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Pickup({{ $count['Pickup'] }})</span></a></li>
                        <li><a href="/type/Wagon"><img src="{{ env('IMAGE_API_URL') . 'images/type/wagon.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Wagon({{ $count['Wagon'] }})</span></a></li>
                        <li><a href="/type/Buses"><img src="{{ env('IMAGE_API_URL') . 'images/type/bus.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Buses({{ $count['Buses'] }})</span></a></li>
                        <li><a href="/type/Mini Buses"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/type/minibus.avif' }}"
                                                loading="lazy" alt="">
                                        <span>Mini
                                                Buses({{ $count['Mini Buses'] }})</span></a></li>
                </ul>
        </div>
        <div class="region">
                <h2 class="heading">Search By Country</h2>
                <ul>
                        <li><a href="/country/Jamaica"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/jamaica.avif' }}"
                                                loading="lazy" alt="country">Jamaica({{ $country['Jamaica'] }})</a></li>
                        <li><a href="/country/Bahamas"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/bahamas.avif' }}"
                                                loading="lazy" alt="country">Bahamas({{ $country['Bahamas'] }})</a>
                        </li>
                        <li><a href="/country/Guyana"><img src="{{ env('IMAGE_API_URL') . 'images/flags/guyana.avif' }}"
                                                loading="lazy" alt="country">Guyana({{ $country['Guyana'] }})</a>
                        </li>
                        <li><a href="/country/Barbados"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/barbados.avif' }}"
                                                loading="lazy" alt="country">Barbados({{ $country['Barbados'] }})</a>
                        </li>
                        <li><a href="/country/Kenya"><img src="{{ env('IMAGE_API_URL') . 'images/flags/kenya.avif' }}"
                                                loading="lazy" alt="country">Kenya({{ $country['Kenya'] }})</a>
                        </li>
                        <li><a href="/country/Tanzania"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/tanzania.avif' }}"
                                                loading="lazy" alt="country">Tanzania({{ $country['Tanzania'] }})</a>
                        </li>
                        <li><a href="/country/Ireland"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/ireland.avif' }}"
                                                loading="lazy" alt="country">Ireland({{ $country['Ireland'] }})</a>
                        </li>
                        <li><a href="/country/UK"><img src="{{ env('IMAGE_API_URL') . 'images/flags/uk.avif' }}"
                                                loading="lazy" alt="country">UK({{ $country['UK'] }})</a></li>
                        <li><a href="/country/Mauritius"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/mauritius.avif' }}"
                                                loading="lazy" alt="country">Mauritius({{ $country['Mauritius'] }})</a>
                        </li>
                        <li><a href="/country/Pakistan"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/pakistan.avif' }}"
                                                loading="lazy" alt="country">Pakistan({{ $country['Pakistan'] }})</a>
                        </li>
                </ul>
        </div>
</aside>
<script>
        document.getElementById('make').addEventListener('change', function () {
                var make = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/get-models?make=' + make, true);
                xhr.onload = function () {
                        if (xhr.status === 200) {
                                var models = JSON.parse(xhr.responseText);
                                var modelDropdown = document.getElementById('model');
                                modelDropdown.innerHTML = '<option disabled selected>Select Model</option>';
                                models.forEach(function (model) {
                                        var option = document.createElement('option');
                                        option.value = model;
                                        option.text = model.toUpperCase();
                                        modelDropdown.appendChild(option);
                                });
                        }
                };
                xhr.send();
        });
</script>