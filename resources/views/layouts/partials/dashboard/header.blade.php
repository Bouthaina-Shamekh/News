<header class="pc-header" id="header">
    <div class="header-wrapper flex justify-between max-sm:px-[15px] px-[25px] grow"><!-- [Mobile Media Block] start -->
        <div class="pc-mob-drp {{ App::getLocale() == 'ar' ? 'mr-0' : 'me-auto'}}" >
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup lg:hidden">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
                        <i class="ti ti-menu-2 text-2xl leading-none"></i>
                    </a>
                </li>
                <li class="pc-h-item max-md:hidden md:inline-flex">
                    {{-- <form class="form-search relative">
                        <i class="search-icon absolute top-[14px] left-[15px]">
                            <svg class="pc-icon w-4 h-4">
                                <use xlink:href="#custom-search-normal-1"></use>
                            </svg>
                        </i>
                        <input type="search" class="form-control px-2.5 pr-3 pl-10 w-[198px] leading-none"
                            placeholder="Ctrl + K" />
                    </form> --}}
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="{{ App::getLocale() == 'ar' ? 'ml-0' : 'ms-auto'}}">
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (app()->currentLocale() != $localeCode)
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle me-0" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img width="20" class="pc-icon" src="{{ asset('assets-dashboard/images/'.$properties['flag']) }}" alt="">
                        </a>
                    </li>
                    @endif
                @endforeach


                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-sun-1"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-moon"></use>
                            </svg>
                            <span>{{__('Dark')}}</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg>
                            <span>{{__("Light")}}</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-setting-2"></use>
                            </svg>
                            <span>{{__('Default')}}</span>
                        </a>
                    </div>
                </li>


                {{-- <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-notification"></use>
                        </svg>
                        <span   id="notifications_count"  class="badge bg-success-500 text-white rounded-full z-10 absolute right-0 top-0">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5">
                            <h5 class="m-0">{{__('Notifications')}}</h5>

                        </div>
                        <div id="unread" class="dropdown-body header-notification-scroll relative py-4 px-5"
                            style="max-height: calc(100vh - 215px)">

                            @foreach(auth()->user()->unreadNotifications as $notification)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="flex gap-4">
                                        <div class="shrink-0">
                                            @if ($notification->type == 'App\Notifications\ContactNotification')
                                                <svg class="pc-icon text-primary w-[22px] h-[22px]">
                                                    <use xlink:href="#custom-sms"></use>
                                                </svg>
                                            @else
                                                <svg class="pc-icon text-primary w-[22px] h-[22px]">
                                                    <use xlink:href="#custom-document-text"></use>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="grow">
                                            <span class="float-end text-sm text-muted">{{ $notification->created_at->format('Y-m-d h:i') }}</span>
                                            <h5 class="text-body mb-2">{{ $notification->data['name'] }}</h5>
                                            <p class="mb-0">
                                                {{ $notification->data['email'] }}
                                            </p>
                                            <p class="mb-0">
                                                {{ $notification->data['phone'] }}
                                            </p>
                                            <p class="mb-0">
                                                {{ $notification->data['message'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="text-center py-2">
                            <form action="{{ route('dashboard.notification.clearAll')}}" method="post">
                                @csrf
                                <button type="submit" class="text-danger-500 hover:text-danger-600 focus:text-danger-600 active:text-danger-600">{{__('Clear all Notifications')}}</button>
                            </form>
                        </div>



                    </div>






                </li> --}}
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="user-image"
                            class="user-avtar w-10 h-10 rounded-full" />
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5">
                            <h5 class="m-0">{{__('Profile')}}</h5>
                        </div>
                        <div class="dropdown-body py-4 px-5">
                            <div class="profile-notification-scroll position-relative"
                                style="max-height: calc(100vh - 225px)">
                                <div class="flex mb-1 items-center">
                                    <div class="shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="user-image" class="w-10 rounded-full" />
                                    </div>
                                    <div class="grow ms-3">
                                        <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <hr class="border-secondary-500/10 my-4" />
                                {{-- <div class="card">
                                    <div class="card-body !py-4">
                                        <div class="flex items-center justify-between">
                                            <h5 class="mb-0 inline-flex items-center">
                                                <svg class="pc-icon text-muted me-2 w-[22px] h-[22px]">
                                                    <use xlink:href="#custom-notification-outline"></use>
                                                </svg>
                                                {{__('Notifications')}}
                                            </h5>
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" value="" class="sr-only peer" />
                                                <div
                                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                <p class="text-span mb-3">{{__("Manage")}}</p>
                                <a href="#" class="dropdown-item">
                                    <span>
                                        <svg class="pc-icon text-muted me-2 inline-block">
                                            <use xlink:href="#custom-setting-outline"></use>
                                        </svg>
                                        <span>{{__('Settings')}}</span>
                                    </span>
                                </a>
                                <hr class="border-secondary-500/10 my-4" />
                                <div class="grid mb-3">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="btn btn-primary flex items-center justify-center">
                                            <svg class="pc-icon me-2 w-[22px] h-[22px]">
                                                <use xlink:href="#custom-logout-1-outline"></use>
                                            </svg>
                                            {{__('Logout')}}
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
