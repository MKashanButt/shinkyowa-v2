<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebInquiryRequest;
use App\Models\Inquiry;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WebStockPageController extends Controller
{
    public function index()
    {
        $queryParams = request()->except('page');
        $vehicles = Stock::with('make', 'bodyType', 'category', 'currency', 'country')->orderBy('id', 'desc')
            ->paginate(8)
            ->appends($queryParams);

        return view('web.stock', compact('vehicles'));
    }

    public function show($id)
    {
        $ip = Inquiry::where('stock_id', $id)
            ->where('ip', request()->getClientIp())
            ->exists();
        $msg = null;
        if ($ip) {
            $msg = 'Inquiry Already Submitted, Please wait for reply';
        }
        $vehicle = Stock::with('make', 'bodyType', 'category', 'currency', 'country')->findOrFail($id);

        $relatedStock = Stock::whereHas('category', fn($r) => $r->where('name', $vehicle->category->name))
            ->limit(6)
            ->get();
        return view('web.vehicle-info', compact('vehicle', 'msg', 'relatedStock'));
    }

    public function filter(Request $request)
    {
        $queryParams = request()->except('page');

        $stock = $request->input('stock');

        $make = $request->input('make');
        $model = $request->input('model');
        $bodyType = $request->input('bodyType');
        $fuelType = $request->input('fuelType');
        $mileage = $request->input('mileage');
        $country = $request->input('country');
        $category = $request->input('category');
        $fueltype = $request->input('fueltype');
        $transmission = $request->input('transmission');
        $yearfrom = $request->input('yearfrom');
        $yearto = $request->input('yearto');

        $query = Stock::query();

        if ($make) {
            $query->whereHas('make', function ($r) use ($make) {
                $r->where('name', $make);
            });
        }
        if ($model) {
            $query->where('model', $model);
        }
        if ($stock) {
            $newId = str_replace('SKI-', '', $stock);
            $query->where('sid', (int) $newId);
        }
        if ($bodyType) {
            $query->whereHas('bodyType', function ($r) use ($bodyType) {
                $r->where('name', $bodyType);
            });
        }
        if ($mileage) {
            if ($mileage == "under 50,000") {
                $query->where('mileage', '<', 50000);
            }
            if ($mileage == "under 100,000") {
                $query->where('mileage', '<', 100000);
            }
            if ($mileage == "under 200,000") {
                $query->where('mileage', '<', 200000);
            }
            if ($mileage == "under 300,000") {
                $query->where('mileage', '<', 300000);
            }
        }
        if ($country) {
            $query->whereHas('country', function ($r) use ($country) {
                $r->where('name', $country);
            });
        }
        if ($category) {
            if ($category !== 'all') {
                $query->whereHas('category', function ($r) use ($category) {
                    $r->where('name', $category);
                });
            }

            $query->with('make', 'bodyType', 'category', 'currency', 'country');
        }
        if ($fueltype) {
            $query->where('fuel', $fueltype);
        }
        if ($transmission) {
            $query->where('transmission', $transmission);
        }
        if ($yearfrom) {
            $query->where('year', '>=', $yearfrom);
        }
        if ($yearto) {
            $query->where('year', '<=', $yearto);
        }

        $totalcount = $query->count();

        $vehicles = $query->orderBy('id', 'desc')
            ->paginate(8)
            ->appends($queryParams);

        return view('web.stock', compact('vehicles'));
    }

    public function stockMakeFilter($make)
    {
        $vehicles = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('make', function ($r) use ($make) {
                $r->where('name', $make);
            })->paginate(8);

        return view('web.stock', compact('vehicles'));
    }

    public function stockBodyTypeFilter($type)
    {
        $vehicles = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('bodyType', function ($r) use ($type) {
                $r->where('name', $type);
            })->paginate(8);

        return view('web.stock', compact('vehicles'));
    }

    public function stockCountryFilter($country)
    {
        $vehicles = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('country', function ($r) use ($country) {
                $r->where('name', $country);
            })->paginate(8);

        return view('web.stock', compact('vehicles'));
    }

    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        if (!$search) {
            return redirect()->back();
        }

        $terms = explode(' ', $search);

        $query = Stock::query()
            ->with(['make']);

        if (count($terms) === 1) {

            $word = $terms[0];

            $query->where(function ($q) use ($word) {
                $q->whereHas('make', fn($m) => $m->where('name', 'LIKE', "%{$word}%"))
                    ->orWhere('model', 'LIKE', "%{$word}%")
                    ->orWhere('year', 'LIKE', "%{$word}%")
                    ->orWhere('chassis', 'LIKE', "%{$word}%");
            });

            $vehicles = $query->orderBy('id', 'desc')->paginate(8);

            return view('web.stock', compact('vehicles'));
        }

        $query->select('stocks.*') // important to avoid ambiguous column names
            ->join('makes', 'stocks.make_id', '=', 'makes.id')
            ->whereRaw("CONCAT_WS(' ', makes.name, stocks.model, stocks.year, stocks.chassis) LIKE ?", ["%{$search}%"])
            ->orderBy('stocks.id', 'desc')
            ->paginate(8)
            ->appends(request()->query());

        $vehicles = $query->orderBy('id', 'desc')->paginate(8);

        return view('web.stock', compact('vehicles'));
    }

    public function storeInquiry(WebInquiryRequest $request)
    {
        $validated = $request->validated();

        Inquiry::create([
            ...$validated,
            "ip" => $request->getClientIp(),
        ]);

        return back()->with('success', 'Inquiry Sent. Please wait till our agent get in touch with you');
    }
}
