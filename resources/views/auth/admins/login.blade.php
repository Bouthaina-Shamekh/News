@include('layouts.partials.dashboard.head', [
    'title' => __('Login'),
])

<!-- [ Main Content ] start -->

<div class="auth-main relative">
    <div class="auth-wrapper v2 flex items-center w-full h-full min-h-screen">
        <div class="auth-sidecontent">
            <img src="{{ asset('assets-dashboard/images/authentication/img-auth-sideimg.jpg') }}" alt="images" class="img-fluid h-screen hidden lg:block" />
        </div>
        <div
            class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-theme-cardbg dark:bg-themedark-cardbg">
            <div class="card sm:my-12 w-full max-w-[480px] border-none shadow-none">
                <div class="card-body sm:!p-10">
                    <div class="text-center">
                        <a href="#">
                            <img src="{{ asset('assets-dashboard/images/logo.png') }}" alt="img" class="mx-auto"
                                width="80%" />
                        </a>
                        @if ($errors->any())
                            <div class="alert alert-danger" >
                                <ol>
                                    @foreach ($errors->getMessages() as $key => $val)
                                        <li>{{ $key . " : " . $val[0] }} </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                        {{-- <div class="grid my-4">
                            <button type="button"
                                class="btn mt-2 flex items-center justify-center gap-2 text-theme-bodycolor dark:text-themedark-bodycolor bg-theme-bodybg dark:bg-themedark-bodybg border border-theme-border dark:border-themedark-border hover:border-primary-500 dark:hover:border-primary-500">
                                <img src="{{ asset('assets-dashboard/images/authentication/facebook.svg') }}"
                                    alt="img" /> <span>{{__('Sign In with Facebook')}}</span>
                            </button>
                            <button type="button"
                                class="btn mt-2 flex items-center justify-center gap-2 text-theme-bodycolor dark:text-themedark-bodycolor bg-theme-bodybg dark:bg-themedark-bodybg border border-theme-border dark:border-themedark-border hover:border-primary-500 dark:hover:border-primary-500">
                                <img src="{{ asset('assets-dashboard/images/authentication/twitter.svg') }}"
                                    alt="img" /> <span>{{__('Sign In with Twitter')}}</span>
                            </button>
                            <button type="button"
                                class="btn mt-2 flex items-center justify-center gap-2 text-theme-bodycolor dark:text-themedark-bodycolor bg-theme-bodybg dark:bg-themedark-bodybg border border-theme-border dark:border-themedark-border hover:border-primary-500 dark:hover:border-primary-500">
                                <img src="{{ asset('assets-dashboard/images/authentication/google.svg') }}"
                                    alt="img" /> <span>{{__('Sign In with Google')}}</span>
                            </button>
                        </div> --}}
                    </div>
                    <div class="relative my-5">
                        <div aria-hidden="true" class="absolute flex inset-0 items-center">
                            <div class="w-full "></div>
                        </div>
                        {{-- <div class="relative flex justify-center">
                            <span class="px-4 bg-theme-cardbg dark:bg-themedark-cardbg">{{__('OR')}}</span>
                        </div> --}}
                    </div>
                    <h4 class="text-center font-medium mb-4">{{__('Login with your email')}}</h4>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="{{__('Email Address')}}" />
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="{{__('Password')}}" />
                        </div>
                        <div class="flex mt-1 justify-between items-center flex-wrap">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox"  name="remember" id="remember_me" checked="" />
                                <label class="form-check-label text-muted" for="remember_me">{{__('Remember me?')}}</label>
                            </div>
                            <h6 class="font-normal text-primary-500 mb-0">
                                <a href="forgot-password-v2.html"> {{__('Forgot Password')}}? </a>
                            </h6>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-full">{{__('Login')}}</button>
                        </div>
                    </form>
                    <div class="flex justify-between items-end flex-wrap mt-4">
                        {{-- <h6 class="f-w-500 mb-0">{{__("Don't have an Account")}}?</h6> --}}
                        {{-- <a href="register-v2.html" class="text-primary-500">{{__('Create Account')}}</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<style>
    .floting-button{
        display: none;
    }
</style>

@include('layouts.partials.dashboard.end')
