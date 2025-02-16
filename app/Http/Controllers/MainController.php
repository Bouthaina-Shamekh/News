<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\About;
use App\Mail\SendMail;
use App\Models\Setting;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function home()
    {
        $ads = Ad::get();
        return view('site.home', compact('ads'));
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
        $settings = Setting::whereIn('key', ['about_ar','about_en','title_ar','title_en', 'phone', 'location','contact_email'])->get();
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
        Mail::to($request->email)->send(new SendMail($data));
        // dd( $request->all());

        return redirect()->back()->with('successSend', true);
        
     }

   


}

