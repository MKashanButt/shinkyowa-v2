<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class WebAjaxController extends Controller
{
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
