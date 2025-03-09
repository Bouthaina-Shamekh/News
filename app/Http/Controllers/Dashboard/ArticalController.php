<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Statu;
use App\Models\Artical;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Artical::class);

        $articals = Artical::with(['category','publisher'])->get();
        $categories  = Category::get();
        $request = request();
        if($request->ajax()){
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
                'articals' => $articals,
                'date' => $request->date,
                'to_date' => $request->to_date
            ]);
        }

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
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'date' => 'required|date',

            'vedio' => 'nullable',
            'img_view' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'img_article' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'text_ar' => 'required',
            'text_en' => 'required',
            'place' => 'required',
            'statu_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
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

            'vedio' => $vedioFilePath,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticalPath,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'place' => $request->place,
            'statu_id' => $request->statu_id,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
        ]);

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
    public function edit(string $id)
    {
        $this->authorize('edit', Artical::class);

        $articals = Artical::findOrFail($id);
        $status = Statu::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('dashboard.articales.edit', compact('articals', 'status', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit', Artical::class);

        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'date' => 'required|date',

            'vedio' => 'nullable',
            'img_view' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'img_article' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'text_ar' => 'required',
            'text_en' => 'required',
            'place' => 'required',
            'statu_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
        ]);

        // Find the article
        $articals = Artical::findOrFail($id);

        $imgViewPath = $articals->img_view;
        // Handle image uploads
        if ($request->hasFile('img_view')) {
            // Delete the old image
            Storage::disk('public')->delete($articals->img_view);
            // Store the new image
            $imgViewPath = $request->file('img_view')->store('uploads', 'public');
        }

        $imgArticalPath = $articals->img_article;
        if ($request->hasFile('img_article')) {
            // Delete the old image
            Storage::disk('public')->delete($articals->img_article);
            // Store the new image
            $imgArticalPath = $request->file('img_article')->store('uploads', 'public');
        }
        $vedioPath = $articals->vedio;
        if ($request->hasFile('vedio')) {
            // Delete the old image
            Storage::disk('public')->delete($articals->vedio);
            // Store the new image
            $vedioPath = $request->file('vedio')->store('uploads', 'public');
        }

        // Update the article
        $articals->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'date' => $request->date,

            'vedio' => $vedioPath,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'place' => $request->place,
            'statu_id' => $request->statu_id,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
            'img_view' => $imgViewPath,
            'img_article' => $imgArticalPath,
        ]);

        return redirect()->route('dashboard.articale.index')->with('success', __('admin.Item updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Artical::class);

        $articals = Artical::findOrFail($id);

        // Delete images from storage
        Storage::disk('public')->delete([$articals->img_view, $articals->img_article]);

        // Delete the article
        $articals->delete();

        return redirect()->route('dashboard.articale.index')->with('success', __('Item deleted successfully.'));
    }
}
