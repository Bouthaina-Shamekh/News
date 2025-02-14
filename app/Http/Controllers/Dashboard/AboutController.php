<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    

    public function edit($id)
    {
        $this->authorize('edit', About::class);
        $abouts = About::findOrFail($id);
        return view('dashboard.abouts.edit', compact('abouts'));
    }




    public function update(Request $request, $id)
    {
        $this->authorize('edit', About::class);
        $request->validate([
            'about_ar' => 'required',
            'about_en' => 'required',
            'objective_ar' => 'required',
            'objective_en' => 'required',
            'mission_ar' => 'required',
            'mission_en' => 'required',
            'vission_ar' => 'required',
            'vission_en' => 'required',
            'goal_ar' => 'required',
            'goal_en' => 'required',
            'image' => 'required|image',
            
        ]);

        $abouts = About::findOrFail($id); 

        $image = $abouts->image;
        if ($request->hasFile('image')) {
            if ($abouts->image && Storage::exists('uploads/abouts/' . $abouts->image)) {
                Storage::delete('uploads/abouts/' . $abouts->image);
            }
            $image = $request->file('image')->store('uploads/abouts', 'public');
        }



        $abouts->update([
             'image' => $image,
             'about_ar' => $request->about_ar,
            'about_en' => $request->about_en,
            'objective_ar' => $request->objective_ar,
            'objective_en' => $request->objective_en,
            'mission_ar' => $request->mission_ar,
            'mission_en' => $request->mission_en,
            'vission_ar' => $request->vission_ar,
            'vission_en' => $request->vission_en,
            'goal_ar' => $request->goal_ar,
            'goal_en' => $request->goal_en,


    ]);



       
        return redirect()->route('dashboard.about.edit',1)->with('success', __('About updated successfully.'));
    }


    public function destroy($id)
    {

        $this->authorize('delete', About::class);
        $abouts = About::findOrFail($id);
        File::delete(public_path('uploads/about/'.$abouts->image));
        $abouts->delete();
        $request = request();
        if ($request->ajax()) {
            return response()->json(['message' => 'Item deleted successfully.']);
        }
        return redirect()->route('dashboard.about.index')->with('success', __('Item deleted successfully.'));
    }
}
