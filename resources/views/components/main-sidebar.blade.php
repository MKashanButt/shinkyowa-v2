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
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/alfa-romeo.png' }}" alt="">
                                        <span>Alfa Romeo({{ $count['Alfa Romeo'] }})</span></a></li>
                        <li><a href="/make/Toyota"><img src="{{ env('IMAGE_API_URL') . 'images/makes/toyota.png' }}"
                                                alt="">
                                        <span>Toyota({{ $count['Toyota'] }})</span></a></li>
                        <li><a href="/make/Nissan"><img src="{{ env('IMAGE_API_URL') . 'images/makes/nissan.png' }}"
                                                alt="">
                                        <span>Nissan({{ $count['Nissan'] }})</span></a></li>
                        <li><a href="/make/Mazda"><img src="{{ env('IMAGE_API_URL') . 'images/makes/mazda.png' }}"
                                                alt="">
                                        <span>Mazda({{ $count['Mazda'] }})</span></a></li>
                        <li><a href="/make/Mitsubishi"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/mitsubishi.png' }}" alt="">
                                        <span>Mitsubishi({{ $count['Mitsubishi'] }})</span></a></li>
                        <li><a href="/make/Honda"><img src="{{ env('IMAGE_API_URL') . 'images/makes/honda.png' }}"
                                                alt="">
                                        <span>Honda({{ $count['Honda'] }})</span></a></li>
                        <li><a href="/make/Suzuki"><img src="{{ env('IMAGE_API_URL') . 'images/makes/suzuki.png' }}"
                                                alt="">
                                        <span>Suzuki({{ $count['Suzuki'] }})</span></a></li>
                        <li><a href="/make/Subaru"><img src="{{ env('IMAGE_API_URL') . 'images/makes/subaru.png' }}"
                                                alt="">
                                        <span>Subaru({{ $count['Subaru'] }})</span></a></li>
                        <li><a href="/make/Isuzu"><img src="{{ env('IMAGE_API_URL') . 'images/makes/isuzu.png' }}"
                                                alt="">
                                        <span>Isuzu({{ $count['Isuzu'] }})</span></a></li>
                        <li><a href="/make/Daihatsu"><img src="{{ env('IMAGE_API_URL') . 'images/makes/daihatsu.png' }}"
                                                alt="">
                                        <span>Daihatsu({{ $count['Daihatsu'] }})</span></a></li>
                        <li><a href="/make/Mitsuoka"><img src="{{ env('IMAGE_API_URL') . 'images/makes/mitsuoka.png' }}"
                                                alt="">
                                        <span>Mitsuoka({{ $count['Mitsuoka'] }})</span></a></li>
                        <li><a href="/make/Lexus"><img src="{{ env('IMAGE_API_URL') . 'images/makes/lexus.png' }}"
                                                alt="">
                                        <span>Lexus({{ $count['Lexus'] }})</span></a></li>
                        <li><a href="/make/BMW"><img src="{{ env('IMAGE_API_URL') . 'images/makes/BMW.png' }}" alt="">
                                        <span>BMW({{ $count['BMW'] }})</span></a></li>
                        <li><a href="/make/Mercedes"><img src="{{ env('IMAGE_API_URL') . 'images/makes/mercedes.png' }}"
                                                alt="">
                                        <span>Mercedes({{ $count['Mercedes'] }})</span></a></li>
                        <li><a href="/make/Audi"><img src="{{ env('IMAGE_API_URL') . 'images/makes/audi.png' }}" alt="">
                                        <span>Audi({{ $count['Audi'] }})</span></a></li>
                        <li><a href="/make/Hino"><img src="{{ env('IMAGE_API_URL') . 'images/makes/hino.png' }}" alt="">
                                        <span>Hino({{ $count['Hino'] }})</span></a></li>
                        <li><a href="/make/Volkswagen"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/makes/volkswagon.png' }}" alt="">
                                        <span>Volkswagen({{ $count['Volkswagen'] }})</span></a></li>
                </ul>
        </div>
        <div class="type">
                <h2 class="heading">Search By Type</h2>
                <ul>
                        <li><a href="/type/Hatchback"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/type/hatchback.png' }}" alt="">
                                        <span>Hatchback({{ $count['Hatchback'] }})</span></a></li>
                        <li><a href="/type/Sedan"><img src="{{ env('IMAGE_API_URL') . 'images/type/sedan.png' }}"
                                                alt="">
                                        <span>Sedan({{ $count['Sedan'] }})</span></a></li>
                        <li><a href="/type/Truck"><img src="{{ env('IMAGE_API_URL') . 'images/type/truck.png' }}"
                                                alt="">
                                        <span>Truck({{ $count['Truck'] }})</span></a></li>
                        <li><a href="/type/SUV"><img src="{{ env('IMAGE_API_URL') . 'images/type/suv.png' }}" alt="">
                                        <span>SUV({{ $count['SUV'] }})</span></a></li>
                        <li><a href="/type/Van"><img src="{{ env('IMAGE_API_URL') . 'images/type/van.png' }}" alt="">
                                        <span>Van({{ $count['Van'] }})</span></a></li>
                        <li><a href="/type/Pickup"><img src="{{ env('IMAGE_API_URL') . 'images/type/pickup.png' }}"
                                                alt="">
                                        <span>Pickup({{ $count['Pickup'] }})</span></a></li>
                        <li><a href="/type/Wagon"><img src="{{ env('IMAGE_API_URL') . 'images/type/wagon.png' }}"
                                                alt="">
                                        <span>Wagon({{ $count['Wagon'] }})</span></a></li>
                        <li><a href="/type/Buses"><img src="{{ env('IMAGE_API_URL') . 'images/type/bus.png' }}" alt="">
                                        <span>Buses({{ $count['Buses'] }})</span></a></li>
                        <li><a href="/type/Mini Buses"><img src="{{ env('IMAGE_API_URL') . 'images/type/minibus.png' }}"
                                                alt="">
                                        <span>Mini
                                                Buses({{ $count['Mini Buses'] }})</span></a></li>
                </ul>
        </div>
        <div class="region">
                <h2 class="heading">Search By Country</h2>
                <ul>
                        <li><a href="/country/Jamaica"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/jamaica.png' }}"
                                                alt="country">Jamaica({{ $country['Jamaica'] }})</a></li>
                        <li><a href="/country/Bahamas"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/bahamas.png' }}"
                                                alt="country">Bahamas({{ $country['Bahamas'] }})</a>
                        </li>
                        <li><a href="/country/Guyana"><img src="{{ env('IMAGE_API_URL') . 'images/flags/guyana.png' }}"
                                                alt="country">Guyana({{ $country['Guyana'] }})</a>
                        </li>
                        <li><a href="/country/Barbados"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/barbados.png' }}"
                                                alt="country">Barbados({{ $country['Barbados'] }})</a>
                        </li>
                        <li><a href="/country/Kenya"><img src="{{ env('IMAGE_API_URL') . 'images/flags/kenya.png' }}"
                                                alt="country">Kenya({{ $country['Kenya'] }})</a>
                        </li>
                        <li><a href="/country/Tanzania"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/tanzania.png' }}"
                                                alt="country">Tanzania({{ $country['Tanzania'] }})</a>
                        </li>
                        <li><a href="/country/Ireland"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/ireland.png' }}"
                                                alt="country">Ireland({{ $country['Ireland'] }})</a>
                        </li>
                        <li><a href="/country/UK"><img src="{{ env('IMAGE_API_URL') . 'images/flags/uk.png' }}"
                                                alt="country">UK({{ $country['UK'] }})</a></li>
                        <li><a href="/country/Mauritius"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/mauritius.png' }}"
                                                alt="country">Mauritius({{ $country['Mauritius'] }})</a>
                        </li>
                        <li><a href="/country/Pakistan"><img
                                                src="{{ env('IMAGE_API_URL') . 'images/flags/pakistan.png' }}"
                                                alt="country">Pakistan({{ $country['Pakistan'] }})</a>
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