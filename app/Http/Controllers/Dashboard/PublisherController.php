<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ActivatePublisherMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Publisher::class);

        $publishers = Publisher::orderBy('id','desc')->get();

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
            $request->merge(['image' => $image]);
        }

        if ($request->hasFile('attachmentsFile')) {
            $attachments = $request->file('attachmentsFile')->store('uploads', 'public');
            $request->merge(['attachments' => $attachments]);
        }



        $publisher = Publisher::create($request->all());

        if($publisher->status == 1) {
            // Mail::to($publisher->email)->send(new ActivatePublisherMail($publisher));
        }


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
            'password' => 'nullable',
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
        if($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }else{
            $request->merge(['password' => $publishers->password]);
        }
        $publishers->update($request->all());

        if($publishers->status == 1) {
            // Mail::to($publishers->email)->send(new ActivatePublisherMail($publishers));
        }


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

    public function accept($id)
    {
        $publisher = Publisher::findOrFail($id);
        $status = $publisher->status;
        if($status == 1) {
            $publisher->status = 0;
        }else{
            $publisher->status = 1;
            // Mail::to($publisher->email)->send(new ActivatePublisherMail($publisher));
        }
        $publisher->save();

        return response()->json([
            'status' => $publisher->status,
            'message' => __('Publisher status updated successfully.')
        ]);
    }
}
