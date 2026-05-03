<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SubscribeServiceMail;
use App\Models\About;
use App\Models\Ad;
use App\Models\Artical;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use App\Models\NewPlace;
use App\Models\Nw;
use App\Models\Podcast;
use App\Models\PodcastEpisode;
use App\Models\Setting;
use App\Models\Video;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function home()
    {
        $ads = Ad::orderBy('id', 'desc')->get();
        $sliders = Nw::active()->where('new_place_id', 4)->orderBy('id', 'desc')->take(5)->get();

        $homeFeaturedVideo = Video::with('category')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('is_featured', true)
            ->latest()
            ->first();

        if (! $homeFeaturedVideo) {
            $homeFeaturedVideo = Video::with('category')
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->latest()
                ->first();
        }

        $homeVideos = Video::with('category')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->when($homeFeaturedVideo, fn ($q) => $q->where('id', '!=', $homeFeaturedVideo->id))
            ->latest()
            ->take(10)
            ->get();

        $homePodcastEpisodes = PodcastEpisode::with('podcast')
            ->latest()
            ->take(6)
            ->get();

        // Categories
        $categoryOne = Category::find(6) ?? Category::first();
        $categoryTwo = Category::find(4) ?? Category::first();
        $categoryThree = Category::find(1) ?? Category::first();

        $articlesOne = Artical::active()->where('category_id', $categoryOne->id)->orderBy('id', 'desc')->get();
        $articlesTwo = Artical::active()->where('category_id', $categoryTwo->id)->orderBy('id', 'desc')->get();
        $articlesThree = Artical::active()->where('category_id', $categoryThree->id)->orderBy('id', 'desc')->get();

        return view('site.home', compact(
            'ads',
            'sliders',
            'categoryOne',
            'categoryTwo',
            'categoryThree',
            'articlesOne',
            'articlesTwo',
            'articlesThree',
            'homeFeaturedVideo',
            'homeVideos',
            'homePodcastEpisodes'
        ));
    }

    public function about()
    {
        $abouts = About::first();

        return view('site.about', compact('abouts'));
    }

    //     public  function send()
    //    {
    //         Mail::to('bou@gmail.com')->send(new SendMail());
    //         return 'Done';

    //    }

    public function contact()
    {
        // $abouts = About::first();
        $settings = Setting::whereIn('key', ['about_ar', 'about_en', 'title_ar', 'title_en', 'phone', 'location', 'contact_email'])->get();

        return view('site.contact', compact('settings'));
    }

    public function contact_data(Request $request)
    {
        $request->validate([
            'fristname' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'msg' => 'required',
        ]);
        $data = $request->except('_token');
        $message = Message::create([
            'msg' => $request->msg,
            'subject' => $request->subject,
            'fristname' => $request->fristname,
            'lastname' => '',
            'email' => $request->email,
            'addDate' => Carbon::now()->format('Y-m-d'),
            'placename' => '',
            'phone' => '',
        ]);

        // Mail::to('info@marenapost.com')->send(new SendMail($data));
        return redirect()->back()->with('successSend', true);
    }

    public function news(Request $request)
    {
        $news = Nw::active()->orderBy('id', 'desc');
        $category = $request->query('c');
        $place = $request->query('pl');
        $search = $request->search;
        if ($category) {
            $news = $news->where('category_id', $category);
        }
        if ($place) {
            $news = $news->where('new_place_id', $place);
        }
        if ($search) {
            $news = $news->where('title_'.app()->getLocale(), 'like', "%{$search}%");
        }
        $news = $news->paginate(10);
       // $categories = Category::all();
     $categories = Category::withCount('nw')
    ->get()
    ->map(function ($category) {
        return $category->nw_count > 0 ? $category : null;
    })
    ->filter()
    ->values();

        $newPalces = NewPlace::all();

        return view('site.news', compact('news', 'categories', 'newPalces'));
    }

    public function new($id)
    {
        $new = Nw::findOrFail((int) $id);

        $news = Nw::active()->orderby('id', 'desc')->where('category_id', $new->category_id)->take(5)->get();
        $new->update([
            'visit' => $new->visit + 1,
        ]);
        $comments = Comment::where('news_id', $new->id)->get();

        return view('site.new', compact('new', 'comments', 'news'));
    }

    public function newLike(Request $request, $id)
    {
        $type = $request->type;
        $new = Nw::findOrFail((int) $id);
        if ($type == true) {
            $new->update([
                'like' => $new->like + 1,
            ]);
        } else {
            $new->update([
                'dislike' => $new->dislike + 1,
            ]);
        }

        return response()->json([
            'msg' => 'success',
        ]);
    }

    public function comment(Request $request)
    {
        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'text' => $request->comment,
            'news_id' => $request->nw_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'time' => Carbon::now()->format('H:i:s'),
        ]);

        return redirect()->route('site.new', $request->nw_id);
    }

    public function articles(Request $request)
    {
        $articles = Artical::active(); // تأكد إن scopeActive مرجّع Builder

        $category = $request->query('c');
        $search = $request->search;
        $place = $request->query('pl');

        if ($category) {
            $articles->where('category_id', $category);
        }

        if ($search) {
            $articles->where('title_'.app()->getLocale(), 'like', "%{$search}%");
        }

        if ($place) {
            if ($place == 1 || $place == 7) {
                $articles->orderBy('like', 'desc');
            } elseif ($place == 2) {
                $articles->orderBy('dislike', 'desc');
            } elseif ($place == 3) {
                $articles->orderBy('visit', 'desc');
            }
        } else {
            $articles->orderBy('id', 'desc');
        }

        $articles = $articles->paginate(10);
       // $categories = Category::all();
       $categories = Category::withCount('article')
    ->get()
    ->map(function ($category) {
        return $category->article_count > 0 ? $category : null;
    })
    ->filter()
    ->values();

        $newPalces = [
            ['id' => 1, 'name_ar' => 'Hot', 'name_en' => 'Hot'],
            ['id' => 2, 'name_ar' => 'عصري', 'name_en' => 'Trendy'],
            ['id' => 3, 'name_ar' => 'الأكثر مشاهدة', 'name_en' => 'Most Watched'],
            ['id' => 7, 'name_ar' => 'الأكثر شهرة', 'name_en' => 'Most Popular'],
        ];

        return view('site.articles', compact('articles', 'categories', 'newPalces'));
    }

    public function article($id)
    {
        $article = Artical::findOrFail((int) $id);
        $article->update([
            'visit' => $article->visit + 1,
        ]);
        $articles = Artical::active()->orderby('id', 'desc')->where('category_id', $article->category_id)->take(5)->get();

        return view('site.article', compact('article', 'articles'));
    }

    public function podcast($slug)
    {
        $podcast = Podcast::where('slug', $slug)->orWhere('id', $slug)->with('episodes')->firstOrFail();

        $episodes = $podcast->episodes()->latest()->get();

        $requestedEpisodeId = request()->query('episode');
        $firstEpisode = $episodes->first();
        if ($requestedEpisodeId) {
            $selected = $episodes->firstWhere('id', (int) $requestedEpisodeId);
            if ($selected) {
                $firstEpisode = $selected;
            }
        }

        $relatedPodcasts = Podcast::where('id', '!=', $podcast->id)
            ->latest()
            ->take(10)
            ->get();

        return view('site.podcast', compact(
            'podcast',
            'episodes',
            'firstEpisode',
            'relatedPodcasts'
        ));
    }

    public function podcasts()
    {
        $podcasts = Podcast::latest()->take(4)->get();

        $episodes = PodcastEpisode::with('podcast')
            ->latest()
            ->take(6)
            ->get();

        $videos = Video::with('category')
            ->latest()
            ->take(10)
            ->get();

        return view('site.podcasts', compact(
            'podcasts',
            'episodes',
            'videos'
        ));
    }

    public function video($slug)
{
    $video = Video::with('category')->where('slug', $slug)->firstOrFail();

    // ✅ تحديد رابط التشغيل (HLS أو عادي)
    $videoSource = null;
    if ($video->hls_path && $video->status === 'ready') {
        $videoSource = asset('storage/' . $video->hls_path);
    } elseif ($video->vedio) {
        $videoSource = asset('storage/' . $video->vedio);
    } elseif ($video->video_url) {
        $videoSource = $video->video_url;
    }

    $cookieName = 'viewed_videos';
    $now = Carbon::now();
    $cutoff = $now->copy()->subHours(2)->timestamp;
    $viewed = [];

    $raw = request()->cookie($cookieName);
    if (is_string($raw) && $raw !== '') {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $viewed = $decoded;
        }
    }

    foreach ($viewed as $videoId => $ts) {
        if (! is_numeric($ts) || (int) $ts < $cutoff) {
            unset($viewed[$videoId]);
        }
    }

    $key = (string) $video->id;
    if (! array_key_exists($key, $viewed)) {
        $video->increment('views_count');
        $viewed[$key] = $now->timestamp;
    }

    $relatedVideos = Video::with('category')
        ->where('category_id', $video->category_id)
        ->where('id', '!=', $video->id)
        ->latest()
        ->take(4)
        ->get();

    $moreVideos = Video::with('category')
        ->where('id', '!=', $video->id)
        ->latest()
        ->take(8)
        ->get();

    $breakingNews = Artical::latest()->take(3)->get();

    $podcasts = Podcast::latest()->take(3)->get();

    $mostViewedVideos = Video::with('category')
        ->where('id', '!=', $video->id)
        ->orderByDesc('views_count')
        ->latest('id')
        ->take(8)
        ->get();

    $response = response()->view('site.video', compact(
        'video',
        'videoSource', // ✅ جديد
        'relatedVideos',
        'moreVideos',
        'breakingNews',
        'podcasts',
        'mostViewedVideos'
    ));

    return $response->cookie(
        $cookieName,
        json_encode($viewed, JSON_UNESCAPED_UNICODE),
        120
    );
}

 public function videos()
{
    $featured = Video::with('category')
        ->latest()
        ->take(5)
        ->get();

    $latestVideos = Video::with('category')
        ->latest()
        ->take(8)
        ->get();

    $mostViewedVideos = Video::with('category')
        ->latest()
        ->take(8)
        ->get();

    $categorySliders = Category::whereHas('videos')
        ->with(['videos' => function ($q) {
            $q->latest()->take(12);
        }])
        ->take(5)
        ->get();

    return view('site.videos', compact(
        'featured',
        'latestVideos',
        'mostViewedVideos',
        'categorySliders'
    ));
}

    public function articleLike(Request $request, $id)
    {
        $type = $request->type;
        $article = Artical::findOrFail((int) $id);
        if ($type == true) {
            $article->update([
                'like' => $article->like + 1,
            ]);
        } else {
            $article->update([
                'dislike' => $article->dislike + 1,
            ]);
        }

        return response()->json([
            'msg' => 'success',
        ]);
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

    public function addEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;
        if (DB::table('email')->where('email', $email)->exists()) {
            return redirect()->back()->with('successAdd', true);
        } else {
            DB::table('email')->insert([
                'email' => $email,
            ]);
            // Mail::to($request->email)->send(new SubscribeServiceMail($email));
        }

        return redirect()->back()->with('successAdd', true);
    }
}
