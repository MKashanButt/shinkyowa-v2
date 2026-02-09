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
        $shipments = Shipment::with('stock')
            ->when(Auth::user()->hasPermission('view_team_shipments'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->whereHas('role', fn($r) => $r->where('name', 'agent'))
                    ->pluck('id')
                    ->toArray();

                $managerAgentIds[] = Auth::id();

                $query->whereIn('user_id', $managerAgentIds);
            })
            ->when(Auth::user()->hasPermission('view_own_shipments'), function ($query) {
                $query->whereHas('stock', function ($r) {
                    $r->whereHas('customerAccount', function ($q) {
                        $q->where('agent_id', Auth::id());
                    });
                });
            })
            ->paginate(8);

        // dd($shipments);

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
