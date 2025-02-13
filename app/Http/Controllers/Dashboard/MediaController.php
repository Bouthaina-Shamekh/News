<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\File;
use App\Models\Work;
use App\Models\About;
use App\Models\Media;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', Media::class);
        if($request->ajax()){
            return Media::paginate(100);
        }
        $images = Media::paginate(100);

        return view('dashboard.media.index', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Media::class);
        if(is_array($request->imageFile)){
            $request->validate([
                'imageFile' => 'required|array|min:1',
                'imageFile.*' => 'image|mimes:jpeg,png,jpg,gif',
            ],[
                'imageFile.*' => 'يجب تحميل صورة فقط باصدار jpeg,png,jpg,gif',
            ]);
        }else{
            $request->validate([
                'imageFile' => 'image|mimes:jpeg,png,jpg,gif',
            ],[
                'imageFile' => 'يجب تحميل صورة فقط باصدار jpeg,png,jpg,gif',
            ]);
        }
        if($request->hasFile('imageFile')){
            if(is_array($request->imageFile)){
                foreach ($request->file('imageFile') as $imageFile){
                    $imageName = time() . ' - ' . $imageFile->getClientOriginalName() . '.' . $imageFile->extension();
                    $imagePath = $imageFile->storeAs('images', $imageName, 'public');
                    $mediaData = [
                        'file_name' => $imageFile->getClientOriginalName(),
                        'size' => $imageFile->getSize(),
                        'path' => $imagePath,
                    ];
                    Media::create($mediaData);
                }
            }else{
                $imageFile = $request->file('imageFile');
                $imageName = time() . ' - ' . $imageFile->getClientOriginalName() . '.' . $imageFile->extension();
                $imagePath = $imageFile->storeAs('images', $imageName, 'public');
                $mediaData = [
                    'file_name' => $imageFile->getClientOriginalName(),
                    'size' => $imageFile->getSize(),
                    'path' => $imagePath,
                ];
                Media::create($mediaData);
            }

            if($request->ajax()){
                return response()->json(['path' => $mediaData['path']]);
            }
            // return redirect()->back()->with('success', 'تم رفع الصور بنجاح');
            return redirect()->back()->withInput()->with('success', 'تم رفع الصور بنجاح');
        }else{
            return redirect()->back()->with('error', 'يجب تحميل الصورة');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', Media::class);
        $image  = Media::findOrFail($id);

        // الفحص في جدول الأصناف والمنتجات اذا وجدت الصورة
        $workImage = Work::where('image', $image->path)->first();
        $partnerImage = Partner::where('image', $image->path)->first();
        $serviceImage = Service::where('image', $image->path)->first();
        $clientImage = Client::where('image', $image->path)->first();
        $teamImage = Team::where('image', $image->path)->first();

        if($workImage != null || $partnerImage != null || $serviceImage != null || $clientImage != null || $teamImage != null){
            $confirmation_deletion = $request->confirmation_deletion;
            if($confirmation_deletion == null){
                return response()->json(['error' => 'لا يمكن حذف هذه الصورة بسبب تحميلها لاحدى المنتجات والأصناف', 'confirmation_deletion' => false], 400);
            }
        }
        $image_old = $image->path;
        if($image_old != null){
            Storage::delete('public/'.$image_old);
        }
        if($workImage != null){
            $workImage->image = null;
            $workImage->save();
        }
        if($partnerImage != null){
            $partnerImage->image = null;
            $partnerImage->save();
        }
        if($serviceImage != null){
            $serviceImage->image = null;
            $serviceImage->save();
        }
        if($clientImage != null){
            $clientImage->image = null;
            $clientImage->save();
        }
        if($teamImage != null){
            $teamImage->image = null;
            $teamImage->save();
        }
        $image->delete();
        return response()->json(['success' => 'تم حذف الصورة بنجاح']);
    }
}
