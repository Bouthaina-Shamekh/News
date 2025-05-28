<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {

        // return "bou";
        $this->authorize('edit', Setting::class);
        $settings = Setting::whereIn('key', ['site_ar', 'site_en', 'facebook', 'instagram', 'youtube', 'phone', 'contact_email', 'about_ar', 'about_en', 'titel_en', 'titel_ar', 'logo', 'logo_icon'])->pluck('value', 'key');

        return view('dashboard.setting.index', compact('settings'));
    }



    public function update(Request $request)
    {
        $this->authorize('edit', Setting::class);
        $request->validate([
            'site_ar' => 'required',
            'site_en' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'phone' => 'required',
            'contact_email' => 'required',
            'about_ar' => 'required',
            'about_en' => 'required',
            'titel_ar' => 'required',
            'titel_en' => 'required',
            'logo' => 'nullable|image',
            'logo_icon' => 'nullable|image',
        ]);


        $data = $request->except(['_token', '_method', 'logo', 'logo_icon']);



        try {
            foreach ($data as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }




        if ($request->hasFile('logo')) {
            $this->updateImage($request->file('logo'), 'logo');
        }

        if ($request->hasFile('logo_icon')) {
            $this->updateImage($request->file('logo_icon'), 'logo_icon');
        }
        return redirect()->back()->with('success', __('Updated successfully'));
    }

    private function updateImage($file, $key)
    {

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();


        $uploadPath = public_path('uploads/logos');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }


        $file->move($uploadPath, $filename);


        $setting = Setting::where('key', $key)->first();
        if ($setting && $setting->value) {
            $oldFilePath = $uploadPath . '/' . $setting->value;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }


        $updated = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $filename]
        );




        return $updated;
    }

    public function removeImage(Request $request)
    {
        $setting = Setting::where('key', $request->name)->first();
        if(!$setting){
            return response()->json(['success' => false]);
        }
        // Delete the image from storage
        if($request->name == 'logo') {
            if($setting->value != null){
                $oldFilePath = public_path('uploads/logos') . '/' . $setting->value;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }
        if($request->name == 'logo_icon') {
            if($setting->value != null){
                $oldFilePath = public_path('uploads/logos') . '/' . $setting->value;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }
        $setting->delete();
        return response()->json(['success' => true]);
    }
}
