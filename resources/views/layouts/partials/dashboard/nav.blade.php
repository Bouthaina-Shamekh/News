<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height">
            <a href="" class="b-brand flex items-center gap-3">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{asset('assets-dashboard/images/logo-dark.svg')}}" class="img-fluid logo-lg" alt="logo" style="display: none"  />
                <div  style="width: 232px;">
                    <img src="{{asset('asset/img/extra/marina.jpg')}}" class="img-fluid logo-lg" alt="logo" />
                </div>
            </a>
        </div>
        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <div class="card pc-user-card mx-[15px] mb-[15px] bg-theme-sidebaruserbg dark:bg-themedark-sidebaruserbg">
                <div class="card-body !p-5">
                    <div class="flex items-center">
                        <img class="shrink-0 w-[45px] h-[45px] rounded-full" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                            alt="user-image" />
                        <div class="ml-4 mr-2 grow">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>

                        </div>
                        <a class="shrink-0 btn btn-icon inline-flex btn-link-secondary" data-pc-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon w-[22px] h-[22px]">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="hidden pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3 *:flex *:items-center *:py-2 *:gap-2.5 hover:*:text-primary-500">
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
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{route('dashboard.home')}}" class="pc-link">
                        <span class="pc-micon">
                            <span class="pc-micon">
                                <i class="fas fa-home"></i>
                            </span>
                        </span>
                        <span class="pc-mtext">{{__('admin.Home')}}</span>
                    </a>
                </li>
                {{-- <li class="pc-item pc-caption">
                    <label>{{__('Basic')}}</label>
                </li> --}}



                @can('view', 'App\\Models\User')
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.Admin')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.users.index')}}">
                                {{__('admin.Admin')}}
                            </a>
                        </li>
                        {{-- <li class="pc-item">
                            <a class="pc-link" href="">
                                {{__('admin.Roles')}}
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @endcan


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-newspaper"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.Articale')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Artical')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.articale.index')}}">
                                {{__('admin.View Articale')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Artical')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.articale.create')}}">
                                {{__('admin.Add Articale')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="far fa-file-alt"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.News')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Nw')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.nw.index')}}">
                                {{__('admin.View News')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Nw')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.nw.create')}}">
                                {{__('admin.Add News')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>
                

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-toggle-on"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.status')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Statu')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.status.index')}}">
                                {{__('admin. View status')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Statu')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.status.create')}}">
                                {{__('admin.Add status')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="fas fa-puzzle-piece"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.Category')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Category')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.category.index')}}">
                                {{__('admin. View Category')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Category')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.category.create')}}">
                                {{__('admin.Add Category')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-ad"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.Ad')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Ad')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.ad.index')}}">
                                {{__('admin. View Ad')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Ad')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.ad.create')}}">
                                {{__('admin.Add Ad')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-location-arrow"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.NewPlace')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\NewPlace')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.newplace.index')}}">
                                {{__('admin.NewPlace')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\NewPlace')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.newplace.create')}}">
                                {{__('admin.NewPlace')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-map-marker"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.AdPlace')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\AdPlace')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.adplace.index')}}">
                                {{__('admin.AdPlace')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\AdPlace')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.adplace.create')}}">
                                {{__('admin.AdPlace')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                        <i class="fas fa-upload"></i>
                        </span>
                        <span class="pc-mtext">
                            {{__('admin.Publisher')}}
                        </span>
                        @if (App::getLocale() == 'en')
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @else
                        <span class="pc-arrow"><i data-feather="chevron-left"></i></span>
                        @endif
                    </a>
                    <ul class="pc-submenu">

                        @can('view', 'App\\Models\Publisher')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.publisher.index')}}">
                                {{__('admin.View Publisher')}}
                            </a>
                        </li>
                        @endcan

                        @can('view', 'App\\Models\Publisher')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.publisher.create')}}">
                                {{__('admin.Add Publisher')}}
                            </a>
                        </li>
                        @endcan


                    </ul>
                </li>

                @can('edit', 'App\\Models\About')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.about.edit' , ['id' => 1] )}}">
                             {{__('admin.About')}}
                            </a>
                        </li>
                        @endcan


                        @can('edit', 'App\\Models\Setting')
                        <li class="pc-item">
                            <a class="pc-link" href="{{route('dashboard.setting.index')}}">
                             {{__('admin.Settings')}}
                            </a>
                        </li>
                        @endcan



               

                
 
            </ul>
           
        </div>
    </div>
</nav>
