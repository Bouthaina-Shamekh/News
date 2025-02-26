<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Publisher::class);

        $publishers = Publisher::all();

        return view('dashboard.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Publisher::class);
        $publishers = new Publisher();
        return view('dashboard.publishers.create', compact('publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Publisher::class);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:publishers,email',
            'password' => 'required',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'required',
            'birth_of_date' => 'required|date',
            'address' => 'required',
            'about' => 'required',
            'status' => 'required',
           
            'attachmentsFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        if ($request->hasFile('imageFile')) {
            $image = $request->file('imageFile')->store('uploads', 'public');
            $request->merge(['avatar' => $image]);
        }

        if ($request->hasFile('attachmentsFile')) {
            $attachments = $request->file('attachmentsFile')->store('uploads', 'public');
            $request->merge(['attachments' => $attachments]);
        }



        Publisher::create($request->all());

        return redirect()->route('dashboard.publisher.index')->with('success', __('admin.Iteam created successfully.'));
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
    public function edit($id)
    {
        $this->authorize('edit', Publisher::class);
        $publishers = Publisher::findOrFail($id);
        return view('dashboard.publishers.edit', compact('publishers'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', Publisher::class);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:publishers,email',
            'password' => 'required',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'required',
            'birth_of_date' => 'required|date',
            'address' => 'required',
            'about' => 'required',
            'status' => 'required',
           
            'attachmentsFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);





        // Get the old image and attachments paths
        $old_image = $request->old_image;
        $old_attachments = $request->old_attachments;

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

        // Handle attachments file upload
        if ($request->hasFile('attachmentsFile')) {
            $file = $request->file('attachmentsFile'); // upload obj
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);
            $request->merge([
                'attachments' => $path
            ]);
        }

        $publishers = Publisher::findOrFail($id);
        // Update the publisher with the validated data
        $publishers->update($request->all());



        return redirect()->route('dashboard.publisher.index')->with('success', __('Publisher updated successfully.'));
    }



    public function destroy($id)
    {
        $this->authorize('delete', Publisher::class);
        $publishers = Publisher::findOrFail($id);

        if ($publishers->image) {
            Storage::disk('public')->delete($publishers->image);
        }

        if ($publishers->attachments) {
            Storage::disk('public')->delete($publishers->attachments);
        }

        $publishers->delete();

        return redirect()->route('dashboard.publisher.index')->with('success', __('Publisher deleted successfully.'));
    }
}
