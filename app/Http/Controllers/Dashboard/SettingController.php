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
        $settings = Setting::whereIn('key', ['linkedin','instagram','twitter','facebook','snapshat','whatsapp','titel_en', 'titel_ar', 'logo', 'contact_email','currency','policy_ar', 'policy_en','about_ar', 'about_en','phone','location'])->pluck('value', 'key');

        return view('dashboard.setting.index',compact('settings'));
    }



    public function update(Request $request)
{
    $this->authorize('edit', Setting::class);
    $request->validate([
        'linkedin' => 'required',
        'instagram'=> 'required',
        'twitter'=> 'required',
        'facebook' => 'required',
        'snapshat' => 'required',
        'whatsapp' => 'required',
        'titel_ar' => 'required',
        'titel_en' => 'required',
        'logo' => 'nullable|image',
        'contact_email' => 'required',
        'currency' => 'required',
        'policy_ar' => 'required',
        'policy_en' => 'required',
        'about_ar' => 'required',
        'about_en' => 'required',
        'phone' => 'required',
        'location' => 'required',
    ]);


    $data = $request->except(['_token', '_method','logo']);



    try {
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key],['value' => $value]);
        }
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }




    if ($request->logo) {

        $logos = Setting::Where('key','logo')->first();
        if($logos){

            $destination = 'uploads/logos/' . $logos->value;


            if (Storage::exists($destination)) {
                Storage::delete($destination);
            }


            }

            $file = $request->file('logo');

            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/logos'), $filename);


            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $filename]
            );

        }


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
