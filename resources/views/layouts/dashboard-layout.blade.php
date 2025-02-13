@include('layouts.partials.dashboard.head')
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.partials.dashboard.nav')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    @include('layouts.partials.dashboard.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">

        <div class="pc-content">
            <div class="row">
                <x-alart type="success"/>
                <x-alart type="info"/>
                <x-alart type="danger"/>
                @if ($errors->any())
                    <div class="alert alert-danger" >
                        <ol>
                            @foreach ($errors->getMessages() as $key => $val)
                                <li>{{ $key . " : " . $val[0] }} </li>
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <ul class="breadcrumb">
                        {{ $breadcrumbs ?? ''}}
                    </ul>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="grid grid-cols-12 gap-x-6">

                {{ $slot }}
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->


    @include('layouts.partials.dashboard.footer')


    <!-- Settings  -->

    <div class="pct-c-btn block fixed ltr:-right-1 rtl:-left-1 top-[100px] z-[1030] overflow-hidden p-0 border-4 ltr:border-r-0 rtl:border-l-0 ltr:rounded-[50%_4px_4px_50%] rtl:rounded-[4px_50%_50%_4px] shadow-[-6px_0px_14px_1px_rgba(27,46,94,0.04)] border-theme-cardbg dark:border-themedark-cardbg bg-theme-cardbg dark:bg-themedark-cardbg transition-all">
      <a href="#" class="block py-3 px-4 transition-all hover:bg-primary-500/10" data-pc-toggle="offcanvas" data-pc-target="#offcanvas_pc_layout">
        <i class="ph-duotone ph-gear-six block text-[24px] leading-none text-primary-500"></i>
      </a>
    </div>

    <div class="offcanvas pct-offcanvas !w-[320px] offcanvas-end !z-[1031]" tabindex="-1" id="offcanvas_pc_layout" aria-labelledby="offcanvas_pc_layoutLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvas_pc_layoutLabel">Settings</h5>
        <button data-pc-dismiss="#offcanvas_pc_layout" class="text-lg flex items-center justify-center rounded w-7 h-7 text-secondary-500 hover:bg-danger-500/10 hover:text-danger-500">
            <i class="ti ti-x"></i>
        </button>
      </div>
      <div class="offcanvas-body pct-body !px-[25px] !pt-0 h-[calc(100%_-_85px)]">
        <ul class="rounded-lg *:py-4 divide-y divide-inherit border-theme-border dark:border-themedark-border">
          <li class="list-group-item">
            <div class="pc-dark">
              <h6 class="mb-1">Theme Mode</h6>
              <p class="text-muted text-sm mb-4">Choose light or dark mode or Auto</p>
              <div class="grid grid-cols-12 gap-6 theme-color theme-layout">
                <div class="col-span-4">
                  <div class="grid">
                    <button
                      class="preset-btn btn active"
                      data-value="true"
                      onclick="layout_change('light');"
                    >
                      <svg class="pc-icon text-warning-500 w-[22px] h-[22px]">
                        <use xlink:href="#custom-sun-1"></use>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="col-span-4">
                  <div class="grid">
                    <button class="preset-btn btn" data-value="false" onclick="layout_change('dark');">
                      <svg class="pc-icon w-[22px] h-[22px]">
                        <use xlink:href="#custom-moon"></use>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="col-span-4">
                  <div class="grid">
                    <button
                      class="preset-btn btn"
                      data-value="default"
                      onclick="layout_change_default();"
                    >
                      <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                        <i class="ph-duotone ph-cpu text-[26px]"></i>
                      </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="list-group-item">
            <h6 class="mb-1">Theme Contrast</h6>
            <p class="text-muted text-sm mb-4">Choose theme contrast</p>
            <div class="grid grid-cols-12 gap-6 theme-contrast">
              <div class="col-span-6">
                <div class="grid">
                  <button
                    class="preset-btn btn"
                    data-value="true"
                    onclick="layout_theme_contrast_change('true');"
                  >
                    <svg class="pc-icon w-[22px] h-[22px]">
                      <use xlink:href="#custom-mask"></use>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="col-span-6">
                <div class="grid">
                  <button
                    class="preset-btn btn active"
                    data-value="false"
                    onclick="layout_theme_contrast_change('false');"
                  >
                    <svg class="pc-icon w-[22px] h-[22px]">
                      <use xlink:href="#custom-mask-1-outline"></use>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <h6 class="mb-1">Custom Theme</h6>
            <p class="text-muted text-sm mb-4">Choose your primary theme color</p>
            <div class="flex items-center flex-wrap gap-1 mt-3 theme-color preset-color">
              <a href="#" class="group bg-primary-500 active" data-value="preset-1">
                <i class="block group-[.active]:hidden ph-duotone ph-arrow-counter-clockwise text-white text-lg leading-none"></i>
                <i class="hidden group-[.active]:block ph-duotone ph-paint-brush text-white text-lg leading-none"></i>
              </a>
              <a href="#" class="bg-red-500" data-value="preset-2"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-orange-500" data-value="preset-3"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-amber-500" data-value="preset-4"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-yellow-500" data-value="preset-5"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-lime-500" data-value="preset-6"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-green-500" data-value="preset-7"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-emerald-500" data-value="preset-8"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-teal-500" data-value="preset-9"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-cyan-500" data-value="preset-10"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-sky-500" data-value="preset-11"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-blue-500" data-value="preset-12"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-indigo-500" data-value="preset-13"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-violet-500" data-value="preset-14"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-purple-500" data-value="preset-15"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-fuchsia-500" data-value="preset-16"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-pink-500" data-value="preset-17"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
              <a href="#" class="bg-rose-500" data-value="preset-18"><i class="ph-duotone ph-paint-brush text-white text-lg leading-none"></i></a>
            </div>
          </li>
          <li class="list-group-item">
            <h6 class="mb-1">Theme layout</h6>
            <p class="text-muted text-sm mb-4">Choose your layout</p>
            <div class="theme-main-layout flex items-center gap-1 w-full">
              <a href="#!" class="preset-btn btn btn-img active" data-value="vertical">
                <img src="{{asset('assets-dashboard/images/customizer/caption-on.svg')}}" alt="img" class="img-fluid" />
              </a>
              <a href="#!" class="preset-btn btn btn-img" data-value="horizontal">
                <img src="{{asset('assets-dashboard/images/customizer/horizontal.svg')}}" alt="img" class="img-fluid" />
              </a>
              <a href="#!" class="preset-btn btn btn-img" data-value="color-header">
                <img src="{{asset('assets-dashboard/images/customizer/color-header.svg')}}" alt="img" class="img-fluid" />
              </a>
              <a href="#!" class="preset-btn btn btn-img" data-value="compact">
                <img src="{{asset('assets-dashboard/images/customizer/compact.svg')}}" alt="img" class="img-fluid" />
              </a>
              <a href="#!" class="preset-btn btn btn-img" data-value="tab">
                <img src="{{asset('assets-dashboard/images/customizer/tab.svg')}}" alt="img" class="img-fluid" />
              </a>
            </div>
          </li>
          <li class="list-group-item">
            <h6 class="mb-1">Sidebar Caption</h6>
            <p class="text-muted text-sm mb-4">Sidebar Caption Hide/Show</p>
            <div class="grid grid-cols-12 gap-6 theme-color theme-nav-caption">
              <div class="col-span-6">
                <div class="grid">
                  <button
                    class="preset-btn btn-img btn active"
                    data-value="true"
                    onclick="layout_caption_change('true');"
                  >
                    <img src="{{asset('assets-dashboard/images/customizer/caption-on.svg')}}" alt="img" class="img-fluid" />
                  </button>
                </div>
              </div>
              <div class="col-span-6">
                <div class="grid">
                  <button
                    class="preset-btn btn-img btn"
                    data-value="false"
                    onclick="layout_caption_change('false');"
                  >
                    <img src="{{asset('assets-dashboard/images/customizer/caption-off.svg')}}" alt="img" class="img-fluid" />
                  </button>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="pc-rtl">
              <h6 class="mb-1">Theme Layout</h6>
              <p class="text-muted text-sm mb-4">LTR/RTL</p>
              <div class="grid grid-cols-12 gap-6 theme-color theme-direction">
                <div class="col-span-6">
                  <div class="grid">
                    <button
                      class="preset-btn btn-img btn active"
                      data-value="false"
                      onclick="layout_rtl_change('false');"
                    >
                      <img src="{{asset('assets-dashboard/images/customizer/ltr.svg')}}" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
                <div class="col-span-6">
                  <div class="grid">
                    <button
                      class="preset-btn btn-img btn"
                      data-value="true"
                      onclick="layout_rtl_change('true');"
                    >
                      <img src="{{asset('assets-dashboard/images/customizer/rtl.svg')}}" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item pc-box-width">
            <div class="pc-container-width">
              <h6 class="mb-1">Layout Width</h6>
              <p class="text-muted text-sm mb-4">Choose Full or Container Layout</p>
              <div class="grid grid-cols-12 gap-6 theme-color theme-container">
                <div class="col-span-6">
                  <div class="grid">
                    <button
                      class="preset-btn btn-img btn active"
                      data-value="false"
                      onclick="change_box_container('false')"
                    >
                      <img src="{{asset('assets-dashboard/images/customizer/full.svg')}}" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
                <div class="col-span-6">
                  <div class="grid">
                    <button
                      class="preset-btn btn-img btn"
                      data-value="true"
                      onclick="change_box_container('true')"
                    >
                      <img src="{{asset('assets-dashboard/images/customizer/fixed.svg')}}" alt="img" class="img-fluid" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="grid">
              <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
            </div>
          </li>
        </ul>
      </div>
    </div>

    {{-- end settings --}}

@include('layouts.partials.dashboard.end')
