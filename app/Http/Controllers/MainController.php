<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Nw;
use App\Models\About;
use App\Models\Visit;
use App\Mail\SendMail;
use App\Mail\SubscribeServiceMail;
use App\Models\Artical;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Message;
use App\Models\NewPlace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function home()
    {
        $ads = Ad::orderBy('id', 'desc')->get();
        $sliders  = Nw::where('new_place_id', 4)->where('statu_id', 2)->orderBy('id', 'desc')->take(5)->get();

        // Categories
        $categoryOne = Category::find(6) ?? Category::first();
        $categoryTwo = Category::find(4) ?? Category::first();
        $categoryThree = Category::find(1) ?? Category::first();

        $articlesOne = Artical::where('category_id', $categoryOne->id)->where('statu_id', 2)->orderBy('id', 'desc')->get();
        $articlesTwo = Artical::where('category_id', $categoryTwo->id)->where('statu_id', 2)->orderBy('id', 'desc')->get();
        $articlesThree = Artical::where('category_id', $categoryThree->id)->where('statu_id', 2)->orderBy('id', 'desc')->get();
        return view('site.home', compact('ads', 'sliders','categoryOne', 'categoryTwo', 'categoryThree','articlesOne', 'articlesTwo', 'articlesThree'));
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
            'phone' => ''
        ]);
        Mail::to($request->email)->send(new SendMail($data));
        return redirect()->back()->with('successSend', true);
    }

    public function news(Request $request)
    {
        $news = Nw::orderBy('id', 'desc')->where('statu_id', 2);
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
            $news = $news->where('title_' . app()->getLocale(), 'like', "%{$search}%");
        }
        $news = $news->paginate(10);
        $categories = Category::all();
        $newPalces = NewPlace::all();
        return view('site.news', compact('news', 'categories', 'newPalces'));
    }
    public function new($id)
    {
        $new = Nw::findOrFail($id);
        $news = Nw::orderby('id','desc')->where('statu_id', 2)->where('category_id', $new->category_id)->take(5)->get();
        $new->update([
            'visit' => $new->visit + 1
        ]);
        $comments = Comment::where('news_id', $id)->get();
        return view('site.new', compact('new', 'comments','news'));
    }
    public function newLike(Request $request, $id)
    {
        $new = Nw::findOrFail($id);
        $type = $request->type;
        if($type == true){
            $new->update([
                'like' => $new->like + 1
            ]);
        }else{
            $new->update([
                'dislike' => $new->dislike + 1
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
        $articles = Artical::orderBy('id', 'desc');
        $category = $request->query('c');
        if ($category) {
            $articles = $articles->where('category_id', $category);
        }
        $articles = $articles->paginate(10);
        $categories = Category::all();
        $newPalces = NewPlace::all();
        return view('site.articles', compact('articles', 'categories', 'newPalces'));
    }
    public function article($id)
    {
        $article = Artical::findOrFail($id);
        $article->update([
            'visit' => $article->visit + 1
        ]);
        $articles = Artical::orderby('id','desc')->where('category_id', $article->category_id)->take(5)->get();
        return view('site.article', compact('article', 'articles'));
    }

    public function articleLike(Request $request, $id)
    {
        $article = Artical::findOrFail($id);
        $type = $request->type;
        if($type == true){
            $article->update([
                'like' => $article->like + 1
            ]);
        }else{
            $article->update([
                'dislike' => $article->dislike + 1
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
        if(DB::table('email')->where('email', $email)->exists()){
            return redirect()->back()->with('successAdd', true);
        }else{
            DB::table('email')->insert([
                'email' => $email,
            ]);
            Mail::to($request->email)->send(new SubscribeServiceMail($email));
        }
        return redirect()->back()->with('successAdd', true);
    }
}
