<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Ad;
use App\Models\Nw;
use App\Models\About;
use App\Models\Statu;
use App\Models\Visit;
use App\Models\Artical;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{

    public function index()
{
    $ad_count = Ad::count();
    $a_count = Artical::count();
    $n_count = Nw::count();
    $p_count = Publisher::count();
    $s_count = Statu::count();
    $c_count = Category::count();
    $ab_count = About::count();

    $chartjs = app()->chartjs
        ->name('doughnutChartTest')
        ->type('doughnut')
        ->size(['width' => 1200, 'height' => 600]) // حجم الرسم البياني
        ->labels(['Articale', 'News', 'News Status', 'Category', 'Ad', 'Publisher', 'About'])
        ->datasets([
            [
                "label" => "Site Data",
                'backgroundColor' => ["#fedae1", "#fda1b5", "#fd5b8a", "#db1063", "#9b0844", "#6f032d", "#600327"],
                'data' => [$a_count, $n_count, $s_count, $c_count, $ad_count, $p_count, $ab_count],
            ]
        ])
        ->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'animation' => [
                'duration' => 2000, // مدة الحركة بالمللي ثانية (2 ثانية هنا)
                'easing' => 'easeInOutQuad', // نوع الحركة
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                    ]
                ]
            ],
        ]);

    return view('dashboard.index', compact('ad_count', 'a_count', 'n_count', 'p_count', 'chartjs'));
}

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

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($abouts->image && Storage::exists('uploads/abouts/' . $abouts->image)) {
            Storage::delete('uploads/abouts/' . $abouts->image);
        }

        // توليد اسم جديد للصورة وتخزينها
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/abouts'), $img_name);
    }


        $abouts::updat([
             'image' => $img_name,
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




        return redirect()->route('dashboard.about.edit')->with('success', __('About updated successfully.'));
    }


    public function storeVisit(Request $request)
    {
        $visit = Visit::where('session_id', $request->session()->getId());

        if ($visit->exists()) {
            return response()->json(['status' => 'exists']);
        }

        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'url_visited' => $request->input('url_visited'),
            'referrer' => $request->input('referrer'),
            'visit_time' => Carbon::now(),
            'session_id' => $request->session()->getId(),
            'date' => Carbon::now()->format('Y-m-d'),
        ]);

        return response()->json(['status' => 'success']);
    }


}
