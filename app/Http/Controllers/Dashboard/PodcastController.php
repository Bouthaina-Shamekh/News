<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Podcast;
use App\Models\Category;
use App\Models\PodcastEpisode;
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
            ->exists()
        ) {
            $slug = Str::limit($original . '-' . $i, $maxLength, '');
            $i++;
        }

        return $slug;
    }

    public function index()
    {
        $this->authorize('view', Podcast::class);

        // $podcasts = Podcast::with(['category'])->orderBy('id', 'desc');
        $podcasts = Podcast::with(['category', 'episodes'])->orderBy('id', 'desc');
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
        $episodes = collect([]);

        return view('dashboard.podcasts.create', compact('podcasts', 'categories', 'episodes'));
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

            'episodes.img_episode.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'episodes.source.*' => 'nullable|in:upload,url',
            'episodes.audio_url.*' => 'nullable|url',
            'episodes.video_url.*' => 'nullable|url',
        ]);

        $keywords_ar_text = '';

        if ($request->keyword_ar != null) {
            $decoded_ar = json_decode($request->keyword_ar, true);

            $keywords_ar_text = is_array($decoded_ar)
                ? implode('، ', array_column($decoded_ar, 'value'))
                : $request->keyword_ar;
        }

        $keywords_en_text = '';

        if ($request->keyword_en != null) {
            $decoded_en = json_decode($request->keyword_en, true);

            $keywords_en_text = is_array($decoded_en)
                ? implode(', ', array_column($decoded_en, 'value'))
                : $request->keyword_en;
        }

        $slug = $this->generateUniqueSlug(
            Podcast::class,
            $request->title_en ?? $request->title_ar
        );

        $imgViewPath = $request->hasFile('img_view')
            ? $request->file('img_view')->store('uploads', 'public')
            : null;

        $imgPodcastPath = $request->hasFile('img_podcast')
            ? $request->file('img_podcast')->store('uploads', 'public')
            : null;

        $podcast = Podcast::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'keyword_ar' => $keywords_ar_text,
            'keyword_en' => $keywords_en_text,
            'img_view' => $imgViewPath,
            'img_podcast' => $imgPodcastPath,
            'text_ar' => $request->text_ar,
            'text_en' => $request->text_en,
            'category_id' => $request->category_id,
            'slug' => $slug,
        ]);

        if (!empty($request->episodes['title_ar'])) {

            foreach ($request->episodes['title_ar'] as $index => $title) {

                if ($title != null) {

                    $episodeType = $request->episodes['type'][$index] ?? 'audio';
                    $audioUrl = $request->episodes['audio_url'][$index] ?? null;
                    $videoUrl = $request->episodes['video_url'][$index] ?? null;
                    $mediaSource = $request->episodes['source'][$index]
                        ?? (($episodeType === 'video' ? $videoUrl : $audioUrl) ? 'url' : 'upload');
                    $vedioPath = null;
                    $audioPath = null;
                    $duration = null;
                    $audioUrl = $episodeType === 'audio' && $mediaSource === 'url' ? $audioUrl : null;
                    $videoUrl = $episodeType === 'video' && $mediaSource === 'url' ? $videoUrl : null;

                    if ($episodeType === 'video' && $mediaSource === 'upload' && $request->hasFile("episodes.vedio.$index")) {
                        $vedioPath = $request->file("episodes.vedio.$index")->store('uploads', 'public');
                    }

                    if ($episodeType === 'audio' && $mediaSource === 'upload' && $request->hasFile("episodes.audio.$index")) {

                        $audioFile = $request->file("episodes.audio.$index");

                        $audioPath = $audioFile->store('uploads', 'public');

                        $fullPath = storage_path('app/public/' . $audioPath);

                        $duration = $this->getAudioDuration($fullPath);
                    }

                    $imgViewEpisodePath = $request->hasFile("episodes.img_view.$index")
                        ? $request->file("episodes.img_view.$index")->store('uploads', 'public')
                        : null;

                    $imgEpisodePath = $request->hasFile("episodes.img_episode.$index")
                        ? $request->file("episodes.img_episode.$index")->store('uploads', 'public')
                        : null;

                    $episodeKeywordsArText = '';

                    if (!empty($request->episodes['keyword_ar'][$index])) {

                        $decoded_ar = json_decode($request->episodes['keyword_ar'][$index], true);

                        $episodeKeywordsArText = is_array($decoded_ar)
                            ? implode('، ', array_column($decoded_ar, 'value'))
                            : $request->episodes['keyword_ar'][$index];
                    }

                    $episodeKeywordsEnText = '';

                    if (!empty($request->episodes['keyword_en'][$index])) {

                        $decoded_en = json_decode($request->episodes['keyword_en'][$index], true);

                        $episodeKeywordsEnText = is_array($decoded_en)
                            ? implode(', ', array_column($decoded_en, 'value'))
                            : $request->episodes['keyword_en'][$index];
                    }

                    $episodeSlug = $this->generateUniqueSlug(
                        PodcastEpisode::class,
                        $request->episodes['title_en'][$index] ?? $request->episodes['title_ar'][$index]
                    );

                    PodcastEpisode::create([
                        'title_ar' => $request->episodes['title_ar'][$index] ?? null,
                        'title_en' => $request->episodes['title_en'][$index] ?? null,
                        'slug' => $episodeSlug,
                        'date' => $request->episodes['date'][$index] ?? null,
                        'time' => $duration,
                        'type' => $episodeType,
                        'vedio' => $vedioPath,
                        'audio' => $audioPath,
                        'audio_url' => $audioUrl,
                        'video_url' => $videoUrl,
                        'img_view' => $imgViewEpisodePath,
                        'img_episode' => $imgEpisodePath,
                        'text_ar' => $request->episodes['text_ar'][$index] ?? null,
                        'text_en' => $request->episodes['text_en'][$index] ?? null,
                        'keyword_ar' => $episodeKeywordsArText,
                        'keyword_en' => $episodeKeywordsEnText,
                        'podcast_id' => $podcast->id,
                    ]);
                }
            }
        }

        DB::commit();

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('danger', $e->getMessage());
    }

    return redirect()->route('dashboard.podcast.index')
        ->with('success', __('Item created successfully.'));
}

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', Podcast::class);

        $podcasts = Podcast::with('episodes')->findOrFail((int)$id);
        $categories = Category::all();
        $episodes = $podcasts->episodes;

        return view('dashboard.podcasts.edit', compact('podcasts', 'categories', 'episodes'));
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

            'episodes.img_episode.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'episodes.source.*' => 'nullable|in:upload,url',
            'episodes.audio_url.*' => 'nullable|url',
            'episodes.video_url.*' => 'nullable|url',
        ]);

        $podcasts = Podcast::with('episodes')->findOrFail((int)$id);

        $keywords_ar_text = '';

        if ($request->keyword_ar != null) {

            $decoded_ar = json_decode($request->keyword_ar, true);

            $keywords_ar_text = is_array($decoded_ar)
                ? implode('، ', array_column($decoded_ar, 'value'))
                : $request->keyword_ar;
        }

        $keywords_en_text = '';

        if ($request->keyword_en != null) {

            $decoded_en = json_decode($request->keyword_en, true);

            $keywords_en_text = is_array($decoded_en)
                ? implode(', ', array_column($decoded_en, 'value'))
                : $request->keyword_en;
        }

        $title = $request->title_en ?? $request->title_ar;

        if (Str::slug($title) !== Str::slug($podcasts->title_en ?? $podcasts->title_ar)) {

            $slug = $this->generateUniqueSlug(
                Podcast::class,
                $title,
                $podcasts->id
            );

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

        $oldEpisodes = $podcasts->episodes->values()->all();

        PodcastEpisode::where('podcast_id', $podcasts->id)->delete();

        if ($request->episodes && isset($request->episodes['title_ar'])) {

            foreach ($request->episodes['title_ar'] as $index => $episodeTitle) {

                if ($episodeTitle != null) {

                    $oldEpisode = $oldEpisodes[$index] ?? null;
                    $episodeType = $request->episodes['type'][$index] ?? 'audio';
                    $requestAudioUrl = $request->episodes['audio_url'][$index] ?? null;
                    $requestVideoUrl = $request->episodes['video_url'][$index] ?? null;
                    $mediaSource = $request->episodes['source'][$index]
                        ?? (($episodeType === 'video' ? $requestVideoUrl : $requestAudioUrl) ? 'url' : 'upload');

                    $vedioPath = $episodeType === 'video' && $mediaSource === 'upload' ? $oldEpisode?->vedio : null;
                    $audioPath = $episodeType === 'audio' && $mediaSource === 'upload' ? $oldEpisode?->audio : null;
                    $duration = $episodeType === 'audio' && $mediaSource === 'upload' ? $oldEpisode?->time : null;
                    $audioUrl = $episodeType === 'audio' && $mediaSource === 'url' ? $requestAudioUrl : null;
                    $videoUrl = $episodeType === 'video' && $mediaSource === 'url' ? $requestVideoUrl : null;

                    if ($oldEpisode && ($episodeType !== 'video' || $mediaSource !== 'upload' || $request->hasFile("episodes.vedio.$index")) && $oldEpisode->vedio) {
                        Storage::disk('public')->delete($oldEpisode->vedio);
                    }

                    if ($oldEpisode && ($episodeType !== 'audio' || $mediaSource !== 'upload' || $request->hasFile("episodes.audio.$index")) && $oldEpisode->audio) {
                        Storage::disk('public')->delete($oldEpisode->audio);
                    }

                    if ($episodeType === 'video' && $mediaSource === 'upload' && $request->hasFile("episodes.vedio.$index")) {
                        $vedioPath = $request->file("episodes.vedio.$index")->store('uploads', 'public');
                    }

                    if ($episodeType === 'audio' && $mediaSource === 'upload' && $request->hasFile("episodes.audio.$index")) {
                        $audioFile = $request->file("episodes.audio.$index");
                        $audioPath = $audioFile->store('uploads', 'public');
                        $fullPath = storage_path('app/public/' . $audioPath);
                        $duration = $this->getAudioDuration($fullPath);
                    }

                    $imgViewEpisodePath = $oldEpisode?->img_view;

                    if ($request->hasFile("episodes.img_view.$index")) {

                        if ($oldEpisode && $oldEpisode->img_view) {
                            Storage::disk('public')->delete($oldEpisode->img_view);
                        }

                        $imgViewEpisodePath = $request->file("episodes.img_view.$index")->store('uploads', 'public');
                    }

                    $imgEpisodePath = $oldEpisode?->img_episode;

                    if ($request->hasFile("episodes.img_episode.$index")) {

                        if ($oldEpisode && $oldEpisode->img_episode) {
                            Storage::disk('public')->delete($oldEpisode->img_episode);
                        }

                        $imgEpisodePath = $request->file("episodes.img_episode.$index")->store('uploads', 'public');
                    }

                    $episodeKeywordsArText = '';

                    if (
                        isset($request->episodes['keyword_ar'][$index]) &&
                        $request->episodes['keyword_ar'][$index] != null
                    ) {

                        $decoded_ar = json_decode($request->episodes['keyword_ar'][$index], true);

                        $episodeKeywordsArText = is_array($decoded_ar)
                            ? implode('، ', array_column($decoded_ar, 'value'))
                            : $request->episodes['keyword_ar'][$index];
                    }

                    $episodeKeywordsEnText = '';

                    if (
                        isset($request->episodes['keyword_en'][$index]) &&
                        $request->episodes['keyword_en'][$index] != null
                    ) {

                        $decoded_en = json_decode($request->episodes['keyword_en'][$index], true);

                        $episodeKeywordsEnText = is_array($decoded_en)
                            ? implode(', ', array_column($decoded_en, 'value'))
                            : $request->episodes['keyword_en'][$index];
                    }

                    $episodeSlug = $this->generateUniqueSlug(
                        PodcastEpisode::class,
                        $request->episodes['title_en'][$index] ?? $request->episodes['title_ar'][$index]
                    );

                    PodcastEpisode::create([
                        'title_ar' => $request->episodes['title_ar'][$index] ?? null,
                        'title_en' => $request->episodes['title_en'][$index] ?? null,
                        'slug' => $episodeSlug,
                        'date' => $request->episodes['date'][$index] ?? null,
                        'time' => $duration,
                        'type' => $episodeType,
                        'vedio' => $vedioPath,
                        'audio' => $audioPath,
                        'audio_url' => $audioUrl,
                        'video_url' => $videoUrl,
                        'img_view' => $imgViewEpisodePath,
                        'img_episode' => $imgEpisodePath,
                        'text_ar' => $request->episodes['text_ar'][$index] ?? null,
                        'text_en' => $request->episodes['text_en'][$index] ?? null,
                        'keyword_ar' => $episodeKeywordsArText,
                        'keyword_en' => $episodeKeywordsEnText,
                        'podcast_id' => $podcasts->id,
                    ]);
                }
            }
        }

        DB::commit();

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('danger', $e->getMessage());
    }

    return redirect()->route('dashboard.podcast.index')
        ->with('success', __('admin.Item updated successfully.'));
}

   public function destroy($id)
{
    $this->authorize('delete', Podcast::class);

    $podcast = Podcast::with('episodes')->findOrFail((int) $id);

    if ($podcast->img_view) {
        Storage::disk('public')->delete($podcast->img_view);
    }

    if ($podcast->img_podcast) {
        Storage::disk('public')->delete($podcast->img_podcast);
    }

    foreach ($podcast->episodes as $episode) {
        if ($episode->img_view) {
            Storage::disk('public')->delete($episode->img_view);
        }

        if ($episode->img_episode) {
            Storage::disk('public')->delete($episode->img_episode);
        }

        if ($episode->vedio) {
            Storage::disk('public')->delete($episode->vedio);
        }

        if ($episode->audio) {
            Storage::disk('public')->delete($episode->audio);
        }

        $episode->delete();
    }

    $podcast->delete();

    return redirect()
        ->route('dashboard.podcast.index')
        ->with('success', __('Item deleted successfully.'));
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

    private function getAudioDuration($filePath)
    {
        $getID3 = new \getID3;
        $file = $getID3->analyze($filePath);

        if (isset($file['playtime_seconds'])) {
            $seconds = (int) $file['playtime_seconds'];

            return gmdate("H:i:s", $seconds); // مثل 01:20:35
        }

        return null;
    }
}
