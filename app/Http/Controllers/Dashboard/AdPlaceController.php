<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AdPlace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view',AdPlace ::class);

        $adplaces = AdPlace::orderBy('id','desc')->get();

        return view('dashboard.adplaces.index',compact('adplaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', AdPlace::class);
        $adplaces = new AdPlace();
        return view('dashboard.adplaces.create', compact('adplaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', AdPlace::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',

        ]);

        AdPlace::create($request->all());

        return redirect()->route('dashboard.adplace.index')->with('success', __('Item created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit', AdPlace::class);
        $adplaces = AdPlace::findOrFail($id);
        return view('dashboard.adplaces.edit', compact('adplaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit', AdPlace::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',

        ]);

        $adplaces = AdPlace::findOrFail($id);

        $adplaces->update($request->all());

        return redirect()->route('dashboard.adplace.index')->with('success', __('admin.Item updated successfully.'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', AdPlace::class);
        $adplaces = AdPlace::findOrFail($id);
        $adplaces->delete();
        return redirect()->route('dashboard.adplace.index')->with('success', __('Item deleted successfully.'));
    }
}
