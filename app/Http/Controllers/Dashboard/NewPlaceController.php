<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\NewPlace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view',NewPlace ::class);

        $newplaces = NewPlace::all();

        return view('dashboard.newplaces.index',compact('newplaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', NewPlace::class);
        $newplaces = new NewPlace();
        return view('dashboard.newplaces.create', compact('newplaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            
        ]);

        NewPlace::create($request->all());

        return redirect()->route('dashboard.newplace.index')->with('success', __('Item created successfully.'));
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
        $this->authorize('edit', NewPlace::class);
        $newplaces = NewPlace::findOrFail($id);
        return view('dashboard.newplaces.edit', compact('newplaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            
        ]);

        $newplaces = NewPlace::findOrFail($id);

        $newplaces->update($request->all());

        return redirect()->route('dashboard.newplace.index')->with('success', __('Item updated successfully.'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', NewPlace::class);
        $newplaces = NewPlace::findOrFail($id);
        $newplaces->delete();
        return redirect()->route('dashboard.newplace.index')->with('success', __('Item deleted successfully.'));
    }
}
