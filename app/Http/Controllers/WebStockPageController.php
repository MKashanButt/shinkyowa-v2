<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WebStockPageController extends Controller
{
    public function index()
    {
        $queryParams = request()->except('page');
        $vehicles = Stock::orderBy('id', 'desc')
            ->paginate(8)
            ->appends($queryParams);

        return view('web.stock', compact('vehicles'));
    }

    public function show($id)
    {
        $vehicle = Stock::with('make', 'bodyType', 'category', 'currency', 'country')->findOrFail($id);
        return view('web.vehicle-info', compact('vehicle'));
    }

    public function filter(Request $request)
    {
        $queryParams = request()->except('page');

        $make = $request->input('make');
        $model = $request->input('model');
        $stock = $request->input('stock');

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
            $query->where('sid', $stock);
        }
        if ($category) {
            $query->whereHas('category', function ($r) use ($category) {
                $r->where('name', $category);
            });
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
                    ->orWhere('year', 'LIKE', "%{$word}%");
            });

            $vehicles = $query->orderBy('id', 'desc')->paginate(8);

            return view('web.stock', compact('vehicles'));
        }

        $query->select('stocks.*') // important to avoid ambiguous column names
            ->join('makes', 'stocks.make_id', '=', 'makes.id')
            ->whereRaw("CONCAT_WS(' ', makes.name, stocks.model, stocks.year) LIKE ?", ["%{$search}%"])
            ->orderBy('stocks.id', 'desc')
            ->paginate(8)
            ->appends(request()->query());

        $vehicles = $query->orderBy('id', 'desc')->paginate(8);

        return view('web.stock', compact('vehicles'));
    }

    public function getModels(Request $request)
    {
        $make = $request->input('make');
        $models = Stock::whereHas('make', function ($r) use ($make) {
            $r->where('name', $make);
        })->distinct()->pluck('model');

        return response()->json($models);
    }

    public function getFueltype(Request $request)
    {
        $model = $request->input('model');
        $result = [];
        $fueltype = Stock::where('model', $model)->pluck('fuel');
        foreach ($fueltype as $fuel) {
            if (in_array($fueltype, $fuel) == null) {
                array_push($result, $fueltype);
            }
        }

        return response()->json($result);
    }

    public function getYears(Request $request)
    {
        $model = $request->input('model');
        $result = Stock::where('model', $model)->orderBy('year', 'ASC')->distinct()->pluck('year');

        return response()->json($result);
    }
}
