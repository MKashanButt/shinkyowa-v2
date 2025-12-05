<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::withCount('stock')
            ->paginate(8);
        return view("admin.country.index", compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $validated = $request->validated();

        Country::create($validated);

        return redirect()->route('admin.country.index')
            ->with('success', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $validated = $request->validated();

        $country->update($validated);

        return redirect()->route('admin.country.index')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->back()
            ->with('success', 'Country Deleted');
    }
}
