<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Podcast;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodcastController extends Controller
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
        $this->authorize('view', Podcast::class);

        $podcasts = Podcast::with(['category'])->orderBy('id', 'desc');
        $categories = Category::get();
        $request = request();

        if ($request->ajax()) {
            if ($request->title != null) {
                $podcasts = $podcasts->where('title_en', 'like', "%{$request->title}%")
                    ->orWhere('title_ar', 'like', "%{$request->title}%");
            }

            if ($request->category_id != null) {
                $podcasts = $podcasts->where('category_id', $request->category_id);
            }

            return response()->json([
                'podcasts' => $podcasts->get(),
            ]);
        }

        $podcasts = $podcasts->paginate(10);

        return view('dashboard.podcasts.index', compact('podcasts', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Podcast::class);

        $podcasts = new Podcast();
        $categories = Category::all();

        return view('dashboard.podcasts.create', compact('podcasts', 'categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Podcast::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'img_view' => 'required|image',
                'img_podcast' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'category_id' => 'required',
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

            $slug = $this->generateUniqueSlug(Podcast::class, $request->title_en ?? $request->title_ar);

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = null;
            if ($request->hasFile('img_view')) {
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }

            $imgPodcastPath = null;
            if ($request->hasFile('img_podcast')) {
                $imgPodcastPath = $request->file('img_podcast')->store('uploads', 'public');
            }

            Podcast::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'img_view' => $imgViewPath,
                'img_podcast' => $imgPodcastPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'category_id' => $request->category_id,
                'slug' => $slug,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.podcast.index')->with('success', __('Item created successfully.'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', Podcast::class);

        $podcasts = Podcast::findOrFail((int)$id);
        $categories = Category::all();

        return view('dashboard.podcasts.edit', compact('podcasts', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', Podcast::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'img_view' => 'nullable|image',
                'img_podcast' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'category_id' => 'required',
            ]);

            $podcasts = Podcast::findOrFail((int)$id);

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

            if (Str::slug($title) !== Str::slug($podcasts->title_en ?? $podcasts->title_ar)) {
                $slug = $this->generateUniqueSlug(Podcast::class, $title, $podcasts->id);
            } else {
                $slug = $podcasts->slug;
            }

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = $podcasts->img_view;
            if ($request->hasFile('img_view')) {
                if ($podcasts->img_view != null) {
                    Storage::disk('public')->delete($podcasts->img_view);
                }
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }

            $imgPodcastPath = $podcasts->img_podcast;
            if ($request->hasFile('img_podcast')) {
                if ($podcasts->img_podcast != null) {
                    Storage::disk('public')->delete($podcasts->img_podcast);
                }
                $imgPodcastPath = $request->file('img_podcast')->store('uploads', 'public');
            }

            $podcasts->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'img_view' => $imgViewPath,
                'img_podcast' => $imgPodcastPath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'category_id' => $request->category_id,
                'slug' => $slug,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.podcast.index')->with('success', __('admin.Item updated successfully.'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', Podcast::class);

        $podcasts = Podcast::findOrFail((int)$id);

        if ($podcasts->img_view != null) {
            Storage::disk('public')->delete($podcasts->img_view);
        }

        if ($podcasts->img_podcast != null) {
            Storage::disk('public')->delete($podcasts->img_podcast);
        }

        $podcasts->delete();

        return redirect()->route('dashboard.podcast.index')->with('success', __('Item deleted successfully.'));
    }

    public function removeImage(Request $request, $id)
    {
        $podcast = Podcast::findOrFail((int)$id);

        if ($request->name == 'img_view') {
            if ($podcast->img_view != null) {
                Storage::disk('public')->delete($podcast->img_view);
            }
        }

        if ($request->name == 'img_podcast') {
            if ($podcast->img_podcast != null) {
                Storage::disk('public')->delete($podcast->img_podcast);
            }
        }

        $podcast->update([
            $request->name => null
        ]);

        return response()->json(['success' => true]);
    }
}