<?php

namespace App\Http\Controllers\Publisher;

use App\Models\Nw;
use App\Models\Statu;
use App\Models\Category;
use App\Models\NewPlace;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NwController extends Controller
{
    protected function generateUniqueSlug($model, $title, $currentId = null, $field = 'slug', $maxLength = 150)
    {
        $slug = Str::slug($title);
        $slug = Str::limit($slug, $maxLength, '');

        $original = $slug;
        $i = 1;

        // تحقق من التعارض مع مقالات أخرى (باستثناء المقال الحالي)
        while ($model::where($field, $slug)
            ->when($currentId, fn($q) => $q->where('id', '!=', $currentId))
            ->exists()) {
            $slug = Str::limit($original . '-' . $i, $maxLength, '');
            $i++;
        }
        return $slug;
    }
    public function index()
    {


        $news = Nw::with(['newplace','category','publisher','status'])
        ->where('publisher_id', Auth::guard('publisherGuard')->user()->id)
        ->orderBy('id','desc');
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
            if($request->publisher_id != null){
                $news = $news->where('publisher_id', $request->publisher_id);
            }
            if($request->status_id != null){
                $news = $news->where('statu_id', $request->status_id);
            }
            return response()->json([
                'newss' => $news->get(),
            ]);
        }
        $news = $news->paginate(10);

        return view('publisher.news.index', compact('news', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $news = new Nw();
        $categories = Category::all();

        return view('publisher.news.create', compact('news', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title_org' => 'required',
            'date' => 'required|date',
            'img_view' => 'nullable|image',
            'img_article' => 'nullable|image',
            'text_org' => 'required',
            'keyword_org' => 'required',
            'category_id' => 'required',
        ]);

        $slug = $this->generateUniqueSlug(Nw::class, $request->title_org);


        $keywords_org_text = '';
        if($request->keyword_org != null){
            $decoded_org = json_decode($request->keyword_org, true); // نحول الـ JSON إلى مصفوفة
            $keywords_org_text = implode('، ', array_column($decoded_org, 'value'));
        }

        $request->merge([
            'keyword_org' => $keywords_org_text ?? '',
            'slug' => $slug
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
            'title_org' => $request->title_org,
            'text_org' => $request->text_org,
            'keyword_org' => $request->keyword_org,
            'title_ar' => '',
            'title_en' => '',
            'date' => $request->date,
            'vedio' => $vedioFilePath,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticalPath,
            'text_ar' => '',
            'text_en' => '',
            'keyword_ar' => '',
            'keyword_en' => '',
            'category_id' => $request->category_id,
            'publisher_id' => Auth::guard('publisherGuard')->user() ? Auth::guard('publisherGuard')->user()->id : 0,
            'statu_id' => 1,
            'slug' => $slug
        ]);

        return redirect()->route('publisher.waitnews')->with('success', __('Item created successfully.'));
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

        $news = Nw::where('slug', $slug)->first();
        if(!$news){
            $news = Nw::findOrFail((int)$slug);
        }
        $categories = Category::all();

        return view('publisher.news.edit', compact('news','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
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
            'category_id' => 'required',
        ]);

        // Find the news item
        $news = Nw::where('slug', $slug)->first();


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
        $title = $request->title_en ?? $request->title_ar;

        if (Str::slug($title) !== Str::slug($news->title_en ?? $news->title_ar)) {
            $slug = $this->generateUniqueSlug(Nw::class, $title, $news->id);
        } else {
            $slug = $news->slug;
        }
        $request->merge([
            'keyword_ar' => $keywords_ar_text ?? '',
            'keyword_en' => $keywords_en_text ?? '',
            'slug' => $slug
        ]);

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
            'category_id' => $request->category_id,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticlePath,
            'vedio' => $vedioPath,
            'slug' => $slug
        ]);

        return redirect()->back()->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $news = Nw::where('slug', $slug)->first();
        if(!$news){
            $news = Nw::findOrFail((int)$slug);
        }
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

        return redirect()->back()->with('success', __('Item deleted successfully.'));
    }
}
