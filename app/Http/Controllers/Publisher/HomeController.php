<?php

namespace App\Http\Controllers\Publisher;

use App\Models\Nw;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index()
    {

        $acceptnews_count = Nw::where('publisher_id', Auth::guard('publisherGuard')->user()->id)
            ->where('statu_id', 2)
            ->count();
        $waitnews_count = Nw::where('publisher_id', Auth::guard('publisherGuard')->user()->id)
            ->where('statu_id', 1)
            ->count();
        $news_count = Nw::where('publisher_id', Auth::guard('publisherGuard')->user()->id)
            ->count();
        $news = Nw::with(['newplace', 'category', 'publisher', 'status'])
            ->where('publisher_id', Auth::guard('publisherGuard')->user()->id)
            ->orderBy('id', 'desc');
        $categories  = Category::get();

        $news = $news->paginate(10);

        return view('publisher.home', compact('news', 'categories', 'acceptnews_count', 'waitnews_count', 'news_count'));
    }
    public function non_active()
    {
        return view('publisher.non_active');
    }


    public function publisherNews(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $news = Nw::where('publisher_id', $id)->paginate(10);
        return view('site.newsPublisher', compact('publisher', 'news'));
    }
    public function publisher(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('site.publisher', compact('publisher'));
    }

    public function acceptnews()
    {

        $publisher = Auth::guard('publisherGuard')->user();

        $news = Nw::where('publisher_id', $publisher->id)
            ->where('statu_id', 2)
            ->get();

        $categories  = Category::get();
        return view('publisher.acceptnews', compact('news', 'categories'));
    }

    public function waitnews()
    {

        $publisher = Auth::guard('publisherGuard')->user();

        $news = Nw::where('publisher_id', $publisher->id)
            ->where('statu_id', 1)
            ->get();


        $categories  = Category::get();
        return view('publisher.waitnews', compact('news', 'categories'));
    }

    public function forgot_password()
    {
        return view('auth.publishers.forgetPassword');
    }
    public function forgot_password_store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('publishers')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
    public function resetPasswordView(Request $request)
    {
        return view('auth.publishers.reset-password', ['request' => $request]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:confirm_password',
        ]);


        $status = Password::broker('publishers')->reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect(url(app()->getLocale() . '/publisher/login'))->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function profile()
    {
        $publisher = Auth::guard('publisherGuard')->user();
        return view('publisher.profile', compact('publisher'));
    }
    public function profileUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:publishers,email',
            'password' => 'nullable',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'required',
            'birth_of_date' => 'required|date',
            'address' => 'required',
            'about' => 'required',
            'attachmentsFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // Get the old image and attachments paths
        $old_image = $request->old_image;
        $old_attachments = $request->old_attachments;

        // Handle image file upload
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile'); // upload obj
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);
            $request->merge([
                'image' => $path
            ]);
        }

        // Handle attachments file upload
        if ($request->hasFile('attachmentsFile')) {
            $file = $request->file('attachmentsFile'); // upload obj
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);
            $request->merge([
                'attachments' => $path
            ]);
        }

        $publishers = Publisher::findOrFail(Auth::guard('publisherGuard')->user()->id);
        // Update the publisher with the validated data
        if($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }else{
            $request->merge(['password' => $publishers->password]);
        }
        $publishers->update($request->all());

        return redirect()->route('publisher.profile')->with('success', __('Publisher updated successfully.'));
    }
}
