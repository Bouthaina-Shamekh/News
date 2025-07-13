<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Statu;
use App\Models\Artical;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticalController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Artical::class);

        $articals = Artical::with(['category','publisher','status'])->orderBy('id', 'desc');
        $categories  = Category::get();
        $request = request();
        if($request->ajax()){
            if($request->title != null){
                $articals = $articals->where('title_en', 'like', "%{$request->title}%")->orWhere('title_ar', 'like', "%{$request->title}%");
            }
            if($request->date  != null){
                $articals = $articals->where('date','>=', $request->date);
            }
            if($request->to_date != null){
                $articals = $articals->where('date','<=', $request->to_date);
            }
            if($request->category_id != null){
                $articals = $articals->where('category_id', $request->category_id);
            }
            return response()->json([
                'articals' => $articals->get(),
                'date' => $request->date,
                'to_date' => $request->to_date
            ]);
        }
        $articals = $articals->paginate(10);

        return view('dashboard.articales.index', compact('articals','categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Artical::class);

        $articals = new Artical();
        $status = Statu::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('dashboard.articales.create', compact('articals', 'status', 'publishers', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Artical::class);
        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'nullable',
                'img_view' => 'required|image',
                'img_article' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'place' => 'required',
                'statu_id' => 'required',
                'publisher_id' => 'required',
                'category_id' => 'required',
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
            $slug = $this->generateUniqueSlug(Artical::class, $request->title_en ?? $request->title_ar);

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
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

            // Create the article
            Artical::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioFilePath,
                'img_view' => $imgViewPath,
                'img_article' => $imgArticalPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'place' => $request->place,
                'statu_id' => $request->statu_id,
                'publisher_id' => $request->publisher_id,
                'category_id' => $request->category_id,
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.articale.index')->with('success', __('Item created successfully.'));
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
        $this->authorize('edit', Artical::class);

        $articals = Artical::findOrFail((int)$id);
        $status = Statu::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('dashboard.articales.edit', compact('articals', 'status', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit', Artical::class);
        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'nullable',
                'img_view' => 'nullable|image',
                'img_article' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'place' => 'required',
                'statu_id' => 'required',
                'publisher_id' => 'required',
                'category_id' => 'required',
            ]);

            // Find the article
            $articals = Artical::findOrFail((int)$id);

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

            if (Str::slug($title) !== Str::slug($articals->title_en ?? $articals->title_ar)) {
                $slug = $this->generateUniqueSlug(Artical::class, $title, $articals->id);
            } else {
                $slug = $articals->slug;
            }
            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);


            $imgViewPath = $articals->img_view;
            // Handle image uploads
            if ($request->hasFile('img_view')) {
                // Delete the old image
                if($articals->img_view != null){
                    Storage::disk('public')->delete($articals->img_view);
                }
                // Store the new image
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }

            $imgArticalPath = $articals->img_article;
            if ($request->hasFile('img_article')) {
                // Delete the old image
                if($articals->img_article != null){
                    Storage::disk('public')->delete($articals->img_article);
                }
                // Store the new image
                $imgArticalPath = $request->file('img_article')->store('uploads', 'public');
            }
            $vedioPath = $articals->vedio;
            if ($request->hasFile('vedio')) {
                // Delete the old image
                if($articals->vedio != null){
                    Storage::disk('public')->delete($articals->vedio);
                }
                // Store the new image
                $vedioPath = $request->file('vedio')->store('uploads', 'public');
            }

            // Update the article
            $articals->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'place' => $request->place,
                'statu_id' => $request->statu_id,
                'publisher_id' => $request->publisher_id,
                'category_id' => $request->category_id,
                'img_view' => $imgViewPath,
                'img_article' => $imgArticalPath,
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.articale.index')->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Artical::class);

        $articals = Artical::findOrFail((int)$id);

        // Delete images from storage
        if($articals->img_view != null){
            Storage::disk('public')->delete($articals->img_view);
        }
        if($articals->img_article != null){
            Storage::disk('public')->delete($articals->img_article);
        }
        if($articals->vedio != null){
            Storage::disk('public')->delete($articals->vedio);
        }

        // Delete the article
        $articals->delete();

        return redirect()->route('dashboard.articale.index')->with('success', __('Item deleted successfully.'));
    }

    public function removeImage(Request $request, $id)
    {
        $article = Artical::findOrFail((int)$id);
        // Delete the image from storage
        if($request->name == 'img_view') {
            if($article->img_view != null){
                Storage::disk('public')->delete($article->img_view);
            }
        }
        if($request->name == 'img_article') {
            if($article->img_article != null){
                Storage::disk('public')->delete($article->img_article);
            }
        }
        if($request->name == 'vedio') {
            if($article->vedio != null){
                Storage::disk('public')->delete($article->vedio);
            }
        }

        // Update the article item
        $article->update([
            $request->name => null
        ]);

        return response()->json(['success' => true]);
    }
}
