<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Statu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view',Statu ::class);

        $status = Statu::orderBy('id','desc')->get();

        return view('dashboard.status.index',compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Statu::class);
        $status = new Statu();
        return view('dashboard.status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Statu::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',

        ]);

        Statu::create($request->all());

        return redirect()->route('dashboard.status.index')->with('success', __('Item created successfully.'));
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
        $this->authorize('edit', Statu::class);
        $status = Statu::findOrFail($id);
        return view('dashboard.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit', Statu::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',

        ]);

        $status = Statu::findOrFail($id);

        $status->update($request->all());

        return redirect()->route('dashboard.status.index')->with('success', __('admin.Item updated successfully.'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Statu::class);
        $status = Statu::findOrFail($id);
        $status->delete();
        return redirect()->route('dashboard.status.index')->with('success', __('Item deleted successfully.'));
    }
}
