<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){

        // return "bou";
        $this->authorize('edit', Setting::class);
        $settings = Setting::whereIn('key', ['site_ar','site_en','facebook','instagram','youtube','phone','contact_email', 'about_ar', 'about_en','title_en','title_ar', 'logo','logo_icon'])->pluck('value', 'key');

        return view('dashboard.setting.index',compact('settings'));
    }



    public function update(Request $request)
{
    $this->authorize('edit', Setting::class);
    $request->validate([
        'site_ar' => 'required',
        'site_en'=> 'required',
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


    $data = $request->except(['_token', '_method','logo','logo_icon']);



    try {
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key],['value' => $value]);
        }
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    // if ($request->logo) {

    //     $logos = Setting::Where('key','logo')->first();
    //     if($logos){

    //         $destination = 'uploads/logos/' . $logos->value;


    //         if (Storage::exists($destination)) {
    //             Storage::delete($destination);
    //         }


    //         }

    //         $file = $request->file('logo');

    //         $extention = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extention;
    //         $file->move(public_path('uploads/logos'), $filename);


    //         Setting::updateOrCreate(
    //             ['key' => 'logo'],
    //             ['value' => $filename]
    //         );

    //     }

    // تحديث logo
    if ($request->hasFile('logo')) {
        $this->updateImage($request->file('logo'), 'logo');
    }

    // تحديث logo_icon
    if ($request->hasFile('logo_icon')) {
        $this->updateImage($request->file('logo_icon'), 'logo_icon');
    }

    return redirect()->back()->with('success', __('Updated successfully'));
}

private function updateImage($file, $key)
{
    $setting = Setting::where('key', $key)->first();

    if ($setting && Storage::exists('uploads/logos/' . $setting->value)) {
        Storage::delete('uploads/logos/' . $setting->value);
    }

    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads/logos'), $filename);

    Setting::updateOrCreate(['key' => $key], ['value' => $filename]);





        return redirect()->back()->with('success', __('Updated successfully'));
}

    public function showsSection(){

        $this->authorize('edit', Setting::class);
        $sections = Setting::where('key','sections_show')->first() ? json_decode(Setting::where('key','sections_show')->first()->value) : [];

        return view('dashboard.setting.sections',compact('sections'));
    }
    public function showSection(Request $request){
        $key = $request->key;
        $value = $request->value;
        $sections = Setting::where('key','sections_show')->first() ? json_decode(Setting::where('key','sections_show')->first()->value) : [];
        $sections->$key = ($value == 1) ? true : false;
        Setting::updateOrCreate(
            ['key' => 'sections_show'],
            ['value' => json_encode($sections)]
        );
        return response()->json(['success' => true]);
    }
}
