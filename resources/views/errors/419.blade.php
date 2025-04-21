@include('layouts.partials.head', ['title' => Config::get('app.name', 'دار اليتيم الفلسطيني')])
<div class="wrapper vh-100">
    <div class="align-items-center h-100 d-flex w-50 mx-auto">
        <div class="mx-auto text-center">
            <h1 class="display-1 m-0 font-weight-bolder text-danger" style="font-size:80px;">419</h1>
            <h1 class="mb-1 text-muted font-weight-bold">OOPS!</h1>
            <h4 class="mb-3 text-black">حدث خطأ بسيط يرجى العودة وإعادة المحاولة</h4>
            <a href="{{ route('dashboard.home')}}" class="btn btn-lg btn-primary px-5">العودة للصفحة الرئيسية</a>
        </div>
    </div>
</div>
@include('layouts.partials.footer')
@if(Config::get('fortify.guard') == 'web')
<x-site-layout>
    <div class="wrapper vh-100">
        <div class="align-items-center h-100 d-flex w-50 mx-auto">
            <div class="mx-auto text-center">
                <h1 class="display-1 m-0 font-weight-bolder text-danger" style="font-size:80px;">419</h1>
                <h1 class="mb-1 text-muted font-weight-bold">OOPS!</h1>
                <h4 class="mb-3 text-black">{{__('site.A simple error occurred please go back and try again')}}</h4>
                <a href="{{ route('site.index')}}" class="btn btn-lg btn-primary px-5">{{__('site.back_to_home')}}</a>
            </div>
        </div>
    </div>
    </x-site-layout>
@endif
@if(Config::get('fortify.guard') == 'admin' || Config::get('fortify.guard') == 'publisherGuard')
@include('layouts.partials.dashboard.head')
    <div class="wrapper vh-100">
        <div class="align-items-center h-100 d-flex w-50 mx-auto">
            <div class="mx-auto text-center">
                <h1 class="display-1 m-0 font-weight-bolder text-danger" style="font-size:80px;">419</h1>
                <h1 class="mb-1 text-muted font-weight-bold">OOPS!</h1>
                <h4 class="mb-3 text-black">{{__('site.A simple error occurred please go back and try again')}}</h4>
                @if(Config::get('fortify.guard') == 'admin')
                    <a href="{{ route('dashboard.home')}}" class="btn btn-lg btn-primary px-5">{{__('site.back_to_home')}}</a>
                @elseif(Config::get('fortify.guard') == 'publisherGuard')
                    <a href="{{ route('publisher.home')}}" class="btn btn-lg btn-primary px-5">{{__('site.back_to_home')}}</a>
                @endif
            </div>
        </div>
    </div>
@include('layouts.partials.dashboard.end')
@endif
