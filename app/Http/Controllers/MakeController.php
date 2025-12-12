<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMakeRequest;
use App\Http\Requests\UpdateMakeRequest;
use App\Models\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakeController extends Controller
{
    public function index()
    {
        $makes = Make::withCount('stock')
            ->paginate(8);
        return view("admin.make.index", compact('makes'));
    }

    public function create()
    {
        return view('admin.make.create');
    }

    public function store(StoreMakeRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')
                ->store('makes', 'public');
            $validated['image'] = $path;
        }

        Make::create($validated);

        return redirect()->route('make.index')
            ->with('success', 'Make created successfully.');
    }

    public function edit(Make $make)
    {
        return view('make.edit', compact('make'));
    }

    public function update(UpdateMakeRequest $request, Make $make)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($make->image) {
                Storage::disk('public')->delete($make->image);
            }
            $path = $request->file('image')->store('makes', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = $make->image;
        }

        $make->update($validated);

        return redirect()->route('make.index')
            ->with('success', 'Make updated successfully.');
    }

    public function destroy(Make $make)
    {
        if ($make->image) {
            Storage::disk('public')->delete($make->image);
        }

        $make->delete();

        return redirect()->back()
            ->with('success', 'Make Deleted');
    }
}
