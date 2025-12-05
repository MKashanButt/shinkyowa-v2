<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Models\BodyType;
use App\Models\Category;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Make;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with(['make', 'currency', 'customerAccount', 'agent'])->paginate(8);

        return view('admin.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makes = Make::all();
        $currencies = Currency::all();
        $categories = Category::all();
        $countries = Country::all();
        $bodyType = BodyType::all();

        return view(
            'admin.stock.create',
            compact(
                'makes',
                'currencies',
                'categories',
                'countries',
                'bodyType',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreStockRequest $request)
    {
        $validated = $request->validated();
        $sid = 0;

        if (Stock::latest()->first()) {
            $sid = Stock::latest()->first()->sid + 1;
        } else {
            $sid = 1;
        }
        $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
        $validated['thumbnail'] = str_replace('public/', '', $thumbnailPath);

        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $path = $image->store('vehicle-images', 'public');
            $imagePaths[] = str_replace('public/', '', $path);
        }

        $validated["sid"] = $sid;
        $validated["agent_id"] = Auth::id();
        $validated['images'] = json_encode($imagePaths);
        $validated['features'] = json_encode($validated['features']);

        Stock::create($validated);

        return redirect()->route('admin.stock.index')->with('success', 'Vehicle added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        $stock = Stock::with(['make', 'currency', 'country', 'bodyType', 'category'])
            ->findOrFail($stock['id']);

        return view('admin.stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $makes = Make::all();
        $currencies = Currency::all();
        $categories = Category::all();
        $countries = Country::all();
        $bodyType = BodyType::all();

        return view('admin.stock.edit', compact(
            'stock',
            'makes',
            'currencies',
            'categories',
            'countries',
            'bodyType',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $stock)
    {
        $stock = Stock::findOrFail($stock);

        if ($request->hasFile('thumbnail')) {
            if ($stock->thumbnail) {
                Storage::delete($stock->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails');
            $stock->thumbnail = $path;
        } elseif ($request->has('remove_thumbnail')) {
            Storage::delete($stock->thumbnail);
            $stock->thumbnail = null;
        }

        $currentImages = json_decode($stock->images) ?? [];
        $imagesToKeep = [];

        foreach ($currentImages as $image) {
            if (!in_array($image, $request->input('remove_images', []))) {
                $imagesToKeep[] = $image;
            } else {
                Storage::delete($image);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicle-images');
                $imagesToKeep[] = $path;
            }
        }

        $stock->images = json_encode($imagesToKeep);

        $stock->update($request->except(['thumbnail', 'images', 'remove_thumbnail', 'remove_images']));

        return redirect()->route('admin.stock.index')->with('success', 'Stock updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $stocks = Stock::with(['make', 'currency', 'customerAccount', 'agent'])
            ->where('sid', 'LIKE', "%{$search}%")
            ->orWhereHas('make', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->orWhere('chassis', 'LIKE', "%{$search}%")
            ->paginate(8);

        return view('admin.stock.index', compact('stocks', 'search'));
    }

    public function destroy($id)
    {
        if (Auth::check() && !Auth::user()->hasPermission('can_delete_stock')) {
            return abort(403, 'Unauthorized action.');
        }

        $stock = Stock::find($id);

        if (!$stock) {
            return redirect()->route('admin.stock.index')
                ->with('error', 'Vehicle not found!');
        }

        try {
            if ($stock->thumbnail && Storage::disk('public')->exists($stock->thumbnail)) {
                Storage::disk('public')->delete($stock->thumbnail);
            }

            if ($stock->images) {
                $images = json_decode($stock->images, true) ?: [];

                foreach ($images as $image) {
                    if ($image && Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $stock->delete();

            return redirect()->route('admin.stock.index')
                ->with('success', 'Vehicle deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Deletion failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error deleting vehicle: ' . $e->getMessage());
        }
    }
}
