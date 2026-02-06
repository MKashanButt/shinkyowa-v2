<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $shipments = Shipment::with('stock')
            ->when(true, function ($query) use ($user) {
                if ($user->hasPermission('view_team_shipments')) {
                    // Get IDs once before the query
                    $agentIds = User::where('manager_id', $user->id)
                        ->whereHas('role', fn($r) => $r->where('name', 'agent'))
                        ->pluck('id')
                        ->push($user->id); // cleaner than toArray and [] =

                    return $query->whereIn('user_id', $agentIds);
                }

                if ($user->hasPermission('view_own_shipments')) {
                    return $query->where('user_id', $user->id);
                }

                // Optional: If they have no permission, return nothing
                return $query->whereRaw('1 = 0');
            })
            ->paginate(8);

        return view('admin.shipment.index', compact('shipments'));
    }

    public function create()
    {
        $stocks = Stock::pluck('id', 'sid');

        return view('admin.shipment.create', compact('stocks'));
    }

    public function store(StoreShipmentRequest $request)
    {
        $validated = $request->validated();

        $shipment = Shipment::create([
            'vessel_name' => $validated['vessel_name'],
            'eta' => $validated['eta'],
            'etd' => $validated['etd'],
        ]);

        $shipment->stock()->attach($validated['stock_id']);

        return redirect()->route('shipment.index')
            ->with('success', 'Shipment created successfully!');
    }

    public function edit(Shipment $shipment)
    {
        $stocks = Stock::pluck('id', 'sid');

        return view('admin.shipment.edit', compact('shipment', 'stocks'));
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        $validated = $request->validated();

        $shipment->update([
            'vessel_name' => $validated['vessel_name'] ?? $shipment->vessel_name,
            'eta' => $validated['eta'] ?? $shipment->eta,
            'etd' => $validated['etd'] ?? $shipment->etd,
        ]);

        if (isset($validated['stock_id'])) {
            $shipment->stock()->sync($validated['stock_id']);
        }

        return redirect()->route('shipment.index')
            ->with('success', 'Shipment updated successfully!');
    }

    public function destroy(Shipment $shipment)
    {
        if (Auth::check() && !Auth::user()->hasPermission('can_delete_shipment')) {
            return abort(403, 'Unauthorized action.');
        }

        $shipment->stock()->detach();

        $shipment->delete();

        return redirect()->route('shipment.index')
            ->with('success', 'Shipment deleted successfully');
    }
}
