<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    protected function generateUniqueSlug($model, $title, $currentId = null, $field = 'slug', $maxLength = 150)
    {
        $slug = Str::slug($title);
        $slug = Str::limit($slug, $maxLength, '');

        $original = $slug;
        $i = 1;

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
        $this->authorize('view', Video::class);

        $videos = Video::with(['category'])->orderBy('id', 'desc');
        $categories = Category::get();
        $request = request();

        if ($request->ajax()) {
            if ($request->title != null) {
                $videos = $videos->where('title_en', 'like', "%{$request->title}%")
                    ->orWhere('title_ar', 'like', "%{$request->title}%");
            }

            if ($request->date != null) {
                $videos = $videos->where('date', '>=', $request->date);
            }

            if ($request->to_date != null) {
                $videos = $videos->where('date', '<=', $request->to_date);
            }

            if ($request->category_id != null) {
                $videos = $videos->where('category_id', $request->category_id);
            }

            return response()->json([
                'videos' => $videos->get(),
                'date' => $request->date,
                'to_date' => $request->to_date
            ]);
        }

        $videos = $videos->paginate(10);

        return view('dashboard.videos.index', compact('videos', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Video::class);

        $videos = new Video();
        $categories = Category::all();

        return view('dashboard.videos.create', compact('videos', 'categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Video::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'time' => 'nullable',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'required|file',
                'img_view' => 'required|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'category_id' => 'required',
                'is_featured' => 'nullable|boolean',
            ]);

            $keywords_ar_text = '';
            if ($request->keyword_ar != null) {
                $decoded_ar = json_decode($request->keyword_ar, true);
                $keywords_ar_text = implode('، ', array_column($decoded_ar, 'value'));
            }

            $keywords_en_text = '';
            if ($request->keyword_en != null) {
                $decoded_en = json_decode($request->keyword_en, true);
                $keywords_en_text = implode(', ', array_column($decoded_en, 'value'));
            }

            $slug = $this->generateUniqueSlug(Video::class, $request->title_en ?? $request->title_ar);

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = null;
            if ($request->hasFile('img_view')) {
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }
            $imgVideoPath = $imgViewPath;

            $vedioPath = null;
            if ($request->hasFile('vedio')) {
                $vedioPath = $request->file('vedio')->store('uploads', 'public');
            }

            Video::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'time' => $request->time,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioPath,
                'img_view' => $imgViewPath,
                'img_video' => $imgVideoPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'views_count' => 0,
                'is_featured' => $request->boolean('is_featured'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.video.index')->with('success', __('Item created successfully.'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', Video::class);

        $videos = Video::findOrFail((int)$id);
        $categories = Category::all();

        return view('dashboard.videos.edit', compact('videos', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', Video::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'time' => 'nullable',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'nullable|file',
                'img_view' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'category_id' => 'required',
                'is_featured' => 'nullable|boolean',
            ]);

            $videos = Video::findOrFail((int)$id);

            $keywords_ar_text = '';
            if ($request->keyword_ar != null) {
                $decoded_ar = json_decode($request->keyword_ar, true);
                $keywords_ar_text = implode('، ', array_column($decoded_ar, 'value'));
            }

            $keywords_en_text = '';
            if ($request->keyword_en != null) {
                $decoded_en = json_decode($request->keyword_en, true);
                $keywords_en_text = implode(', ', array_column($decoded_en, 'value'));
            }

            $title = $request->title_en ?? $request->title_ar;

            if (Str::slug($title) !== Str::slug($videos->title_en ?? $videos->title_ar)) {
                $slug = $this->generateUniqueSlug(Video::class, $title, $videos->id);
            } else {
                $slug = $videos->slug;
            }

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = $videos->img_view;
            if ($request->hasFile('img_view')) {
                if ($videos->img_view != null) {
                    Storage::disk('public')->delete($videos->img_view);
                }
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }
            $imgVideoPath = $imgViewPath;

            $vedioPath = $videos->vedio;
            if ($request->hasFile('vedio')) {
                if ($videos->vedio != null) {
                    Storage::disk('public')->delete($videos->vedio);
                }
                $vedioPath = $request->file('vedio')->store('uploads', 'public');
            }

            $videos->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'time' => $request->time,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioPath,
                'img_view' => $imgViewPath,
                'img_video' => $imgVideoPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'is_featured' => $request->boolean('is_featured'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.video.index')->with('success', __('admin.Item updated successfully.'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', Video::class);

        $videos = Video::findOrFail((int)$id);

        if ($videos->img_view != null) {
            Storage::disk('public')->delete($videos->img_view);
        }
        if ($videos->img_video != null && $videos->img_video !== $videos->img_view) {
            Storage::disk('public')->delete($videos->img_video);
        }

        if ($videos->vedio != null) {
            Storage::disk('public')->delete($videos->vedio);
        }

        $videos->delete();

        return redirect()->route('dashboard.video.index')->with('success', __('Item deleted successfully.'));
    }

    public function removeImage(Request $request, $id)
    {
        $video = Video::findOrFail((int)$id);

        if ($request->name == 'img_view') {
            if ($video->img_view != null) {
                Storage::disk('public')->delete($video->img_view);
            }
        }

        if ($request->name == 'img_video') {
            if ($video->img_video != null) {
                Storage::disk('public')->delete($video->img_video);
            }
        }

        if ($request->name == 'vedio') {
            if ($video->vedio != null) {
                Storage::disk('public')->delete($video->vedio);
            }
        }

        $video->update([
            $request->name => null
        ]);

        return response()->json(['success' => true]);
    }
}