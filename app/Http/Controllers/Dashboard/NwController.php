<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Nw;
use App\Models\Statu;
use App\Models\Category;
use App\Models\NewPlace;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Nw::class);

        $news = Nw::with(['newplace'])->get();
        // $news = Nw::all();
        $categories  = Category::get();
        // $newplaces = NewPlace::all();
        $request = request();
        if($request->ajax()){
            if($request->date  != null){
                $news = $news->where('date','>=', $request->date);
            }
            if($request->to_date != null){
                $news = $news->where('date','<=', $request->to_date);
            }
            if($request->category_id != null){
                $news = $news->where('category_id', $request->category_id);
            }
            return response()->json([
                'newss' => $news,
            ]);
        }

        return view('dashboard.news.index', compact('news', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Nw::class);

        $news = new Nw();
        $status = Statu::all();
        $categories = Category::all();
        $newplaces = NewPlace::all();
        $publishers = Publisher::all();

        return view('dashboard.news.create', compact('news', 'status', 'categories', 'newplaces', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Nw::class);
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'nullable',
            'date' => 'required|date',
            'img_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'img_article' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'text_ar' => 'required',
            'text_en' => 'nullable',
            'keyword_ar' => 'required',
            'keyword_en' => 'nullable',
            'visit' => 'nullable',
            'statu_id' => 'required',
            'category_id' => 'required',
            'new_place_id' => 'required',
            'publisher_id' => 'nullable',
        ]);

        // Handle image uploads
        $imgViewPath = $request->file('img_view')->store('uploads', 'public');
        $imgArticlePath = $request->file('img_article')->store('uploads', 'public');
        // $vedioPath = $request->file('vedio')->store('uploads', 'public');
        $vedioPath = $request->hasFile('vedio') ? $request->file('vedio')->store('uploads', 'public') : null;

        // Create the news item
        Nw::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'date' => $request->date,
            'vedio' => $vedioPath,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticlePath,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'keyword_ar' => $request->keyword_ar,
            'keyword_en' => $request->keyword_en,
            'visit' => $request->visit,
            'statu_id' => $request->statu_id,
            'category_id' => $request->category_id,
            'new_place_id' => $request->new_place_id,
            'publisher_id' => $request->publisher_id,
        ]);

        return redirect()->route('dashboard.nw.index')->with('success', __('Item created successfully.'));
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
        $this->authorize('edit', Nw::class);

        $news = Nw::findOrFail($id);
        $status = Statu::all();
        $categories = Category::all();
        $newplaces = NewPlace::all();
        $publishers = Publisher::all();

        return view('dashboard.news.edit', compact('news', 'status', 'categories', 'newplaces', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit', Nw::class);

        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'nullable',
            'date' => 'required|date',
            'img_view' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'img_article' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'text_ar' => 'required',
            'text_en' => 'nullable',
            'keyword_ar' => 'required',
            'keyword_en' => 'nullable',
            'visit' => 'nullable',
            'statu_id' => 'required',
            'category_id' => 'required',
            'new_place_id' => 'required',
            'publisher_id' => 'nullable',
        ]);


        // Find the news item
        $news = Nw::findOrFail($id);

        // Handle image uploads
        $imgViewPath = $news->img_view;
        if ($request->hasFile('img_view')) {
            // Delete the old image
            Storage::disk('public')->delete($news->img_view);
            // Store the new image
            $imgViewPath = $request->file('img_view')->store('uploads', 'public');
        }

        $imgArticlePath = $news->img_article;
        if ($request->hasFile('img_article')) {
            // Delete the old image
            Storage::disk('public')->delete($news->img_article);
            // Store the new image
            $imgArticlePath = $request->file('img_article')->store('uploads', 'public');
        }

        $vedioPath = $news->img_article;
        if ($request->hasFile('vedio')) {
            // Delete the old image
            Storage::disk('public')->delete($news->img_article);
            // Store the new image
            $vedioPath = $request->file('vedio')->store('uploads', 'public');
        }

        // Update the news item
        $news->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'date' => $request->date,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'keyword_ar' => $request->keyword_ar,
            'keyword_en' => $request->keyword_en,
            'visit' => $request->visit,
            'statu_id' => $request->statu_id,
            'category_id' => $request->category_id,
            'new_place_id' => $request->new_place_id,
            'publisher_id' => $request->publisher_id,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticlePath,
            'vedio' => $vedioPath,
        ]);

        return redirect()->route('dashboard.nw.index')->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Nw::class);

        $news = Nw::findOrFail($id);

        // Delete images from storage
        Storage::disk('public')->delete([$news->img_view, $news->img_article]);

        // Delete the news item
        $news->delete();

        return redirect()->route('dashboard.nw.index')->with('success', __('Item deleted successfully.'));
    }
}
