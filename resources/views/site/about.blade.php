<x-site-layout>
    @php
        $titel = 'titel_' . app()->getLocale();
        $about = 'about_' . app()->getLocale();
        $objective = 'objective_' . app()->getLocale();
        $mission = 'mission_' . app()->getLocale();
        $vission = 'vission_' . app()->getLocale();
        $goal = 'goal_' . app()->getLocale();
    @endphp
    <div class="container">
        <div class="main--content">
            <div class="post--item post--single pd--30-0">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $setting = \App\Models\Setting::get();
                            $title = $setting->where('key', $titel)->first();
                        @endphp
                        <div class="post--video embed-responsive embed-responsive-16by9">
                            <img src="{{$abouts != null ? asset('storage/' . $abouts->image) : asset('assets/img/صورة_واتساب_بتاريخ_2024-10-09_في_12.53.11_cd9169ce.jpg')}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="post--info">
                            <div class="title">
                                <h2 class="h4">{{ $title && $title->value != null ? $title->value : 'مارينا بوست' }}</h2>
                            </div>
                        </div>
                        <div class="post--content">
                            <p>
                                {{ $abouts[$about] ? $abouts[$about] : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info--blocks ptop--30">
                <ul class="nav row">
                    <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                        <div class="info--block">
                            <div class="icon text--color-1">
                                <i class="fa fa-dashboard"></i>
                            </div>
                            <div class="title">
                                <h3 class="h5">{{ app()->getLocale() == 'ar' ? 'أهدافنا' : 'goal'}}</h3>
                            </div>
                            <div class="content">
                                <p>
                                    {{ $abouts[$goal] ? $abouts[$goal] : '' }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                        <div class="info--block">
                            <div class="icon text--color-1">
                                <i class="fa fa-cog"></i>
                            </div>
                            <div class="title">
                                <h3 class="h5">{{ app()->getLocale() == 'ar' ? 'رؤيتنا' : 'vission'}}</h3>
                            </div>
                            <div class="content">
                                <p>
                                    {{ $abouts[$vission] ? $abouts[$vission] : '' }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                        <div class="info--block">
                            <div class="icon text--color-1">
                                <i class="fa fa-diamond"></i>
                            </div>
                            <div class="title">
                                <h3 class="h5">{{ app()->getLocale() == 'ar' ? 'مهمتنا' : 'mission'}}</h3>
                            </div>
                            <div class="content">
                                <p>
                                    {{ $abouts[$mission] ? $abouts[$mission] : '' }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                        <div class="info--block">
                            <div class="icon text--color-1">
                                <i class="fa fa-object-group"></i>
                            </div>
                            <div class="title">
                                <h3 class="h5">{{ app()->getLocale() == 'ar' ? 'قيمتنا' : 'objective'}}</h3>
                            </div>
                            <div class="content">
                                <p>
                                    {{ $abouts[$objective] ? $abouts[$objective] : '' }}
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</x-site-layout>
