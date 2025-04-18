@php
$userDone = Auth::guard('publisherGuard')->user();
@endphp
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height">
            <a href="{{route('site.index')}}" class="b-brand flex items-center gap-3">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{asset('assets-dashboard/images/logo-dark.svg')}}" class="img-fluid logo-lg" alt="logo" style="display: none" />
                <div style="width: 232px;">
                    <img src="{{asset('asset/img/extra/marina.jpg')}}" class="img-fluid logo-lg" alt="logo" />
                </div>
            </a>
        </div>
        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <div class="card pc-user-card mx-[15px] mb-[15px] bg-theme-sidebaruserbg dark:bg-themedark-sidebaruserbg">
                <div class="card-body !p-5">
                    <div class="flex items-center">
                        <img class="shrink-0 w-[45px] h-[45px] rounded-full" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="user-image" />
                        <div class="ml-4 mr-2 grow">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>

                        </div>
                        <a class="shrink-0 btn btn-icon inline-flex btn-link-secondary" data-pc-toggle="collapse" href="#pc_sidebar_userlink">
                            <svg class="pc-icon w-[22px] h-[22px]">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="hidden pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3 *:flex *:items-center *:py-2 *:gap-2.5 hover:*:text-primary-500">
                            @if($userDone && $userDone->status == 1)
                            <a href="{{route('dashboard.users.profile', Auth::user()->id)}}">
                                <i class="text-lg leading-none ti ti-user"></i>
                                <span>{{__('admin.My_account')}}</span>
                            </a>
                            @can('view', 'App\\Models\Setting')
                            <a href="{{route('dashboard.setting.index')}}">
                                <i class="text-lg leading-none ti ti-settings"></i>
                                <span>{{__('admin.Settings')}}</span>
                            </a>
                            @endcan
                            @else
                            <div class="text-center">
                                <h3>{{app()->getLocale() == 'ar' ? 'اليوزر ليس مفعل' : 'Your_account_is_not_active'}}</h3>
                            </div>
                            @endif
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" style="display: flex; align-items: center; gap: 5px;">
                                    <i class="text-lg leading-none ti ti-power"></i>
                                    <span>{{__('admin.Logout')}}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($userDone && $userDone->status == 1)
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{route('publisher.home')}}" class="pc-link">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-home"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.Home')}}</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{route('publisher.nw.create')}}" class="pc-link" target="_blank">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.Create News')}}</span>
                    </a>
                </li>


                <li class="pc-item">
                    <a href="{{route('publisher.waitnews')}}" class="pc-link">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.Wait News')}}</span>
                    </a>
                </li>


                <li class="pc-item">
                    <a href="{{route('publisher.acceptnews')}}" class="pc-link">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.Accept News')}}</span>
                    </a>
                </li>

                
                <li class="pc-item">
                    <a href="{{route('site.publisherNews',$userDone->id)}}" class="pc-link">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.My News')}}</span>
                    </a>
                </li>

              
            </ul>
            @else
                <div class="text-center">
                    <h3>{{app()->getLocale() == 'ar' ? 'اليوزر ليس مفعل' : 'Your_account_is_not_active'}}</h3>
                </div>
            @endif

        </div>
    </div>
</nav>
