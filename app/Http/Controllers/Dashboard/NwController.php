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
use Illuminate\Support\Str;

class NwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Nw::class);

        $news = Nw::with(['newplace','category','publisher','status'])->orderBy('id','desc');
        $categories  = Category::get();
        $request = request();
        if($request->ajax()){
            if($request->keyword != null){
                $decoded_en = json_decode($request->keyword, true); // نحول الـ JSON إلى مصفوفة
                $keywords_en_text = implode(', ', array_column($decoded_en, 'value'));
                $news = $news->where('keyword_en', 'like', "$keywords_en_text");
            }
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
                'newss' => $news->get(),
            ]);
        }
        $news = $news->paginate(10);

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
            'img_view' => 'required|image',
            'img_article' => 'nullable|image',
            'text_ar' => 'required',
            'text_en' => 'nullable',
            'keyword_ar' => 'required',
            'keyword_en' => 'nullable',

            'statu_id' => 'required',
            'category_id' => 'required',
            'new_place_id' => 'required',
            'publisher_id' => 'nullable',
        ]);

        $keywords_ar_text = '';
        if($request->keyword_ar != null){
            $decoded_ar = json_decode($request->keyword_ar, true); // نحول الـ JSON إلى مصفوفة
            $keywords_ar_text = implode('، ', array_column($decoded_ar, 'value'));
        }
        $keywords_en_text = '';
        if($request->keyword_en != null){
            $decoded_en = json_decode($request->keyword_en, true); // نحول الـ JSON إلى مصفوفة
            $keywords_en_text = implode(', ', array_column($decoded_en, 'value'));
        }
        $slug = Str::slug($request->title_en ?? $request->title_ar);
        $slug = Str::limit($slug, 255, '');
        $request->merge([
            'keyword_ar' => $keywords_ar_text ?? '',
            'keyword_en' => $keywords_en_text ?? '',
        ]);

        // Handle image uploads
        $imgViewPath = null;
        if ($request->hasFile('img_view')) {
            $imgViewPath = $request->file('img_view')->store('uploads', 'public');
        }

        $imgArticalPath = null;
        if ($request->hasFile('img_article')) {
            $imgArticalPath = $request->file('img_article')->store('uploads', 'public');
        }

        $vedioFilePath = null;
        if ($request->hasFile('vedio')) {
            $vedioFilePath = $request->file('vedio')->store('uploads', 'public');
        }

        // Create the news item
        Nw::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'date' => $request->date,
            'vedio' => $vedioFilePath,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticalPath,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'keyword_ar' => $request->keyword_ar,
            'keyword_en' => $request->keyword_en,

            'statu_id' => $request->statu_id,
            'category_id' => $request->category_id,
            'new_place_id' => $request->new_place_id,
            'publisher_id' => $request->publisher_id,
            'slug' => $slug
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
    public function edit($slug)
    {
        $this->authorize('edit', Nw::class);
        $news = Nw::where('slug', $slug)->first();
        $status = Statu::all();
        $categories = Category::all();
        $newplaces = NewPlace::all();
        $publishers = Publisher::all();

        return view('dashboard.news.edit', compact('news', 'status', 'categories', 'newplaces', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $this->authorize('edit', Nw::class);

        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'nullable',
            'date' => 'required|date',
            'img_view' => 'nullable|image',
            'img_article' => 'nullable|image',
            'text_ar' => 'required',
            'text_en' => 'nullable',
            'keyword_ar' => 'required',
            'keyword_en' => 'nullable',
            'statu_id' => 'required',
            'category_id' => 'required',
            'new_place_id' => 'required',
            'publisher_id' => 'nullable',
        ]);

        $keywords_ar_text = '';
        if($request->keyword_ar != null){
            $decoded_ar = json_decode($request->keyword_ar, true); // نحول الـ JSON إلى مصفوفة
            $keywords_ar_text = implode('، ', array_column($decoded_ar, 'value'));
        }
        $keywords_en_text = '';
        if($request->keyword_en != null){
            $decoded_en = json_decode($request->keyword_en, true); // نحول الـ JSON إلى مصفوفة
            $keywords_en_text = implode(', ', array_column($decoded_en, 'value'));
        }
        $slug = Str::slug($request->title_en ?? $request->title_ar);
        $slug = Str::limit($slug, 255, '');
        $request->merge([
            'keyword_ar' => $keywords_ar_text ?? '',
            'keyword_en' => $keywords_en_text ?? '',
            'slug' => $slug
        ]);

        // Find the news item
        $news = Nw::where('slug', $slug)->first();

        // Handle image uploads
        $imgViewPath = $news->img_view;
        if ($request->hasFile('img_view')) {
            // Delete the old image
            if($news->img_view != null){
                Storage::disk('public')->delete($news->img_view);
            }
            // Store the new image
            $imgViewPath = $request->file('img_view')->store('uploads', 'public');
        }

        $imgArticlePath = $news->img_article;
        if ($request->hasFile('img_article')) {
            // Delete the old image
            if($news->img_article != null){
                Storage::disk('public')->delete($news->img_article);
            }
            // Store the new image
            $imgArticlePath = $request->file('img_article')->store('uploads', 'public');
        }

        $vedioPath = $news->img_article;
        if ($request->hasFile('vedio')) {
            // Delete the old image
            if($news->img_article != null){
                Storage::disk('public')->delete($news->img_article);
            }
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

            'statu_id' => $request->statu_id,
            'category_id' => $request->category_id,
            'new_place_id' => $request->new_place_id,
            'publisher_id' => $request->publisher_id,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticlePath,
            'vedio' => $vedioPath,
            'slug' => $slug
        ]);

        return redirect()->route('dashboard.nw.index')->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $this->authorize('delete', Nw::class);

        $news = Nw::where('slug', $slug)->first();

        // Delete images from storage
        if($news->img_view != null){
            Storage::disk('public')->delete($news->img_view);
        }
        if($news->img_article != null){
            Storage::disk('public')->delete($news->img_article);
        }
        if($news->vedio != null){
            Storage::disk('public')->delete($news->vedio);
        }

        // Delete the news item
        $news->delete();

        return redirect()->route('dashboard.nw.index')->with('success', __('Item deleted successfully.'));
    }

    public function removeImage(Request $request, $slug)
    {
        $news = Nw::where('slug', $slug)->first();
        // Delete the image from storage
        if($request->name == 'img_view') {
            if($news->img_view != null){
                Storage::disk('public')->delete($news->img_view);
            }
        }
        if($request->name == 'img_article') {
            if($news->img_article != null){
                Storage::disk('public')->delete($news->img_article);
            }
        }
        if($request->name == 'vedio') {
            if($news->vedio != null){
                Storage::disk('public')->delete($news->vedio);
            }
        }

        // Update the news item
        $news->update([
            $request->name => null
        ]);

        return response()->json(['success' => true]);
    }
}
