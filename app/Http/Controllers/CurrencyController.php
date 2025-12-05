<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::withCount('stock')
            ->paginate(8);
        return view("admin.currency.index", compact('currencies'));
    }
    public function create()
    {
        return view('admin.currency.create');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $validated = $request->validated();

        Currency::create($validated);

        return redirect()->route('admin.currency.index')
            ->with('success', 'Currency created successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currency.edit', compact('currency'));
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $validated = $request->validated();

        $currency->update($validated);

        return redirect()->route('admin.currency.index')
            ->with('success', 'Currency updated successfully.');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->back()
            ->with('success', 'Currency Deleted');
    }
}
