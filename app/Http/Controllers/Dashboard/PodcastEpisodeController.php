<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Podcast;
use App\Models\PodcastEpisode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodcastEpisodeController extends Controller
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
        $this->authorize('view', PodcastEpisode::class);

        $episodes = PodcastEpisode::with(['podcast'])->orderBy('id', 'desc');
        $podcasts = Podcast::get();
        $categories = Category::get();
        $request = request();

        if ($request->ajax()) {
            if ($request->title != null) {
                $episodes = $episodes->where('title_en', 'like', "%{$request->title}%")
                    ->orWhere('title_ar', 'like', "%{$request->title}%");
            }

            if ($request->date != null) {
                $episodes = $episodes->where('date', '>=', $request->date);
            }

            if ($request->to_date != null) {
                $episodes = $episodes->where('date', '<=', $request->to_date);
            }

            if ($request->podcast_id != null) {
                $episodes = $episodes->where('podcast_id', $request->podcast_id);
            }

            return response()->json([
                'episodes' => $episodes->get(),
                'date' => $request->date,
                'to_date' => $request->to_date
            ]);
        }

        $episodes = $episodes->paginate(10);

        return view('dashboard.podcast_episodes.index', compact('episodes', 'podcasts', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', PodcastEpisode::class);

        $episodes = new PodcastEpisode();
        $podcasts = Podcast::all();

        return view('dashboard.podcast_episodes.create', compact('episodes', 'podcasts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', PodcastEpisode::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'time' => 'nullable',
                'type' => 'required|in:audio,video',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'nullable|file',
                'audio' => 'nullable|file',
                'img_view' => 'nullable|image',
                'img_episode' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'podcast_id' => 'required',
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

            $slug = $this->generateUniqueSlug(PodcastEpisode::class, $request->title_en ?? $request->title_ar);

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = null;
            if ($request->hasFile('img_view')) {
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }

            $imgEpisodePath = null;
            if ($request->hasFile('img_episode')) {
                $imgEpisodePath = $request->file('img_episode')->store('uploads', 'public');
            }

            $vedioPath = null;
            if ($request->hasFile('vedio')) {
                $vedioPath = $request->file('vedio')->store('uploads', 'public');
            }

            $audioPath = null;
            if ($request->hasFile('audio')) {
                $audioPath = $request->file('audio')->store('uploads', 'public');
            }

            PodcastEpisode::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'time' => $request->time,
                'type' => $request->type,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioPath,
                'audio' => $audioPath,
                'img_view' => $imgViewPath,
                'img_episode' => $imgEpisodePath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'podcast_id' => $request->podcast_id,
                'slug' => $slug,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.podcast_episode.index')->with('success', __('Item created successfully.'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', PodcastEpisode::class);

        $episodes = PodcastEpisode::findOrFail((int)$id);
        $podcasts = Podcast::all();

        return view('dashboard.podcast_episodes.edit', compact('episodes', 'podcasts'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', PodcastEpisode::class);

        DB::beginTransaction();
        try {
            $request->validate([
                'title_ar' => 'required',
                'title_en' => 'required',
                'date' => 'required|date',
                'time' => 'nullable',
                'type' => 'required|in:audio,video',
                'keyword_ar' => 'nullable',
                'keyword_en' => 'nullable',
                'vedio' => 'nullable|file',
                'audio' => 'nullable|file',
                'img_view' => 'nullable|image',
                'img_episode' => 'nullable|image',
                'text_ar' => 'required',
                'text_en' => 'required',
                'podcast_id' => 'required',
            ]);

            $episodes = PodcastEpisode::findOrFail((int)$id);

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

            if (Str::slug($title) !== Str::slug($episodes->title_en ?? $episodes->title_ar)) {
                $slug = $this->generateUniqueSlug(PodcastEpisode::class, $title, $episodes->id);
            } else {
                $slug = $episodes->slug;
            }

            $request->merge([
                'keyword_ar' => $keywords_ar_text ?? '',
                'keyword_en' => $keywords_en_text ?? '',
                'slug' => $slug
            ]);

            $imgViewPath = $episodes->img_view;
            if ($request->hasFile('img_view')) {
                if ($episodes->img_view != null) {
                    Storage::disk('public')->delete($episodes->img_view);
                }
                $imgViewPath = $request->file('img_view')->store('uploads', 'public');
            }

            $imgEpisodePath = $episodes->img_episode;
            if ($request->hasFile('img_episode')) {
                if ($episodes->img_episode != null) {
                    Storage::disk('public')->delete($episodes->img_episode);
                }
                $imgEpisodePath = $request->file('img_episode')->store('uploads', 'public');
            }

            $vedioPath = $episodes->vedio;
            if ($request->hasFile('vedio')) {
                if ($episodes->vedio != null) {
                    Storage::disk('public')->delete($episodes->vedio);
                }
                $vedioPath = $request->file('vedio')->store('uploads', 'public');
            }

            $audioPath = $episodes->audio;
            if ($request->hasFile('audio')) {
                if ($episodes->audio != null) {
                    Storage::disk('public')->delete($episodes->audio);
                }
                $audioPath = $request->file('audio')->store('uploads', 'public');
            }

            $episodes->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'date' => $request->date,
                'time' => $request->time,
                'type' => $request->type,
                'keyword_ar' => $request->keyword_ar,
                'keyword_en' => $request->keyword_en,
                'vedio' => $vedioPath,
                'audio' => $audioPath,
                'img_view' => $imgViewPath,
                'img_episode' => $imgEpisodePath,
                'text_ar' => $request->text_ar,
                'text_en' => $request->text_en,
                'podcast_id' => $request->podcast_id,
                'slug' => $slug,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->route('dashboard.podcast_episode.index')->with('success', __('admin.Item updated successfully.'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', PodcastEpisode::class);

        $episodes = PodcastEpisode::findOrFail((int)$id);

        if ($episodes->img_view != null) {
            Storage::disk('public')->delete($episodes->img_view);
        }

        if ($episodes->img_episode != null) {
            Storage::disk('public')->delete($episodes->img_episode);
        }

        if ($episodes->vedio != null) {
            Storage::disk('public')->delete($episodes->vedio);
        }

        if ($episodes->audio != null) {
            Storage::disk('public')->delete($episodes->audio);
        }

        $episodes->delete();

        return redirect()->route('dashboard.podcast_episode.index')->with('success', __('Item deleted successfully.'));
    }

    public function removeImage(Request $request, $id)
    {
        $episode = PodcastEpisode::findOrFail((int)$id);

        if ($request->name == 'img_view') {
            if ($episode->img_view != null) {
                Storage::disk('public')->delete($episode->img_view);
            }
        }

        if ($request->name == 'img_episode') {
            if ($episode->img_episode != null) {
                Storage::disk('public')->delete($episode->img_episode);
            }
        }

        if ($request->name == 'vedio') {
            if ($episode->vedio != null) {
                Storage::disk('public')->delete($episode->vedio);
            }
        }

        if ($request->name == 'audio') {
            if ($episode->audio != null) {
                Storage::disk('public')->delete($episode->audio);
            }
        }

        $episode->update([
            $request->name => null
        ]);

        return response()->json(['success' => true]);
    }
}