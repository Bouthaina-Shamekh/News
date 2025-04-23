@include('layouts.partials.publisher.head',['title' => 'User is not active'])

{{-- @if(Auth::guard('publisherGuard')->user()->status == 1)
    <script>
        window.location.href = "{{ route('publisher.home') }}";
    </script>
@endif --}}

<div class="auth-main relative">
    <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
        <div class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-[url('../images/authentication/img-auth-bg.jpg')] dark:bg-none dark:bg-themedark-bodybg">
            <div class="card sm:my-12 w-full max-w-[480px] shadow-none">
                <div class="card-body !p-10">
                    <a href="#">
                        <img src="{{ asset('assets/img/صورة_واتساب_بتاريخ_2024-10-09_في_12.53.11_cd9169ce.jpg') }}" class="mb-4 img-fluid" alt="img" /></a>
                    <div class="flex justify-center items-end mb-4">
                        <h3 class="text-center">
                            @if(app()->getLocale() == 'ar')
                                شكرا لتسجيلك في موقع ماريتا بوست الرجاء الإنتظار لحين الموافقة على المستخدم من قبل الإدارة
                            @else
                                Thank you for registering on the Marietta Post website. Please wait until the user is approved by the administration
                            @endif
                        </h3>
                    </div>
                    <div class="grid mt-3">
                        <a href="{{ route('site.index') }}" class="btn btn-primary">
                            {{ app()->getLocale() == 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                        </a>
                    </div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="grid mt-3">
                            <button type="submit" class="btn btn-danger">
                                {{ app()->getLocale() == 'ar' ? 'تسجيل الخروج' : 'Logout' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.publisher.end')
