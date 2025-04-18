<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ad;
use App\Models\AdPlace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Ad::class);
        $ads = Ad::with(['adplace'])->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Ad::class);
        $ads = new Ad();
        $adplases = AdPlace::all();
        return view('dashboard.ads.create', compact('ads', 'adplases'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', Ad::class);
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Ensure it's an image
            'owner' => 'required',
            'owner_phone' => 'required',
            'price' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'required',
            'visit' => 'required',
            'ad_place_id' => 'required',
        ]);

        // Initialize image path as null
        $imagePath = null;

        // Handle image file upload
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile'); // upload obj
            $imagePath = $file->store('uploads', [
                'disk' => 'public'
            ]);
        }
        Ad::create([
            'image' => $imagePath, // Use 'image' instead of 'imageFile'
            'title' => $request->title,
            'url' => $request->url,
            'owner' => $request->owner,
            'owner_phone' => $request->owner_phone,
            'price' => $request->price,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'visit' => $request->visit ?? 0,
            'ad_place_id' => $request->ad_place_id,
        ]);



        return redirect()->route('dashboard.ad.index')->with('success', __('admin.Item created successfully.'));
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
        $this->authorize('edit', Ad::class);
        $ads = Ad::findOrFail($id);
        $adplases = AdPlace::all();
        return view('dashboard.ads.edit', compact('ads', 'adplases'));
    }



    public function update(Request $request, string $id)
    {
        $this->authorize('edit', Ad::class);
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'imageFile' => 'nullable',
            'owner' => 'required',
            'owner_phone' => 'required',
            'price' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'required',
            'visit' => 'required',
            'ad_place_id' => 'required',
        ]);

        // Get the old image path
        $old_image = $request->old_image;

        // Handle image file upload
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile'); // upload obj
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);

            $request->merge([
                'image' => $path
            ]);
        }

        // Find the ad by ID
        $ads = Ad::findOrFail($id);

        // Update the ad
        $ads->update([
            'image' => $request->image ?? $ads->image, // Use the new image if provided, otherwise keep the old one
            'title' => $request->title,
            'url' => $request->url,
            'owner' => $request->owner,
            'owner_phone' => $request->owner_phone,
            'price' => $request->price,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'visit' => $request->visit ?? 0,
            'ad_place_id' => $request->ad_place_id,
        ]);

        // Delete the old image if a new image is uploaded
        if ($old_image && $request->hasFile('imageFile')) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.ad.index')->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Ad::class);
        $ads = Ad::findOrFail($id);
        $ads->delete();
        return redirect()->route('dashboard.ad.index')->with('success', __('admin.Item deleted successfully.'));
    }
}
