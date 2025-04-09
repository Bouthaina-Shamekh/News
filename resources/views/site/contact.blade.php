<x-site-layout>
    @php
        $titel = 'titel_' . app()->getLocale();
        $about = 'about_' . app()->getLocale();
    @endphp
    <div class="contact--section pd--30-0" style="direction: rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 ptop--30 pbottom--30 footer_nav">
                    <div class="contact--info">
                        <ul class="nav">
                            <li>
                                <div class="title">
                                    <h3 class="h5"><i class="fa fa-phone-square"></i>{{__('admin.Phone')}}</h3>
                                </div>
                                <div class="content">
                                    <p><a href="tel:soon">{{ $settings->where('key', 'phone')->first()->value ?? '' }}</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <h3 class="h5">
                                        <i class="fa fa-envelope-open"></i>{{__('admin.Email') }}
                                    </h3>
                                </div>
                                <div class="content">
                                    <p>
                                        <a
                                            href="/cdn-cgi/l/email-protection#41282f272e012c2033242f20312e32356f222e2c"><span
                                                class="__cf_email__"
                                                data-cfemail="abc2c5cdc4ebc6cad9cec5cadbc4d8df85c8c4c6">{!! $settings->where('key', 'contact_email')->first()->value ?? '' !!}</span></a>
                                    </p>
                                    <!-- <p><a href="mailto:example@example.com">example@example.com</a></p> -->
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <h3 class="h5"><i class="fa fa-map-marker"></i>{{__('admin.Address')}}</h3>
                                </div>
                                <div class="content">
                                    <!-- <p>{{ $settings->where('key', 'about_ar')->first()->value ?? '' }}</p> -->
                                    <!-- <p>Kafrul, Dhaka -1219, Bangladesh</p> -->

                                    <p>
            @if(app()->getLocale() == 'ar')
                {!! $settings->where('key', 'about_ar')->first()->value ?? '' !!}
            @else
                {!! $settings->where('key', 'about_en')->first()->value ?? '' !!}
            @endif
        </p>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 ptop--30 pbottom--30 footer_nav">
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form action="{{ route('site.contactdata')}}" method="post">
                                @csrf
                                <div class="status"></div>
                                <div class="row">
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>اسم *</span>
                                            <input type="text" name="fristname" id="fristname" class="form-control"
                                                required
                                                onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('fristname')"
                                                data-cf-modified-8d07fdb62926c6a6680a6920-="" />
                                        </label>
                                        <label>
                                            <span>عنوان بريد الكتروني *</span>
                                            <input type="email" name="email" id="email" class="form-control"
                                                required
                                                onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('email')"
                                                data-cf-modified-8d07fdb62926c6a6680a6920-="" />
                                        </label>
                                        <label>
                                            <span>* الموضوع</span>
                                            <input type="text" name="subject" id="subject" class="form-control"
                                                onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('subject')"
                                                data-cf-modified-8d07fdb62926c6a6680a6920-="" />
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>تعليق *</span>
                                            <textarea name="msg" id="msg" class="form-control" required
                                                onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('msg')"
                                                data-cf-modified-8d07fdb62926c6a6680a6920-=""></textarea>
                                        </label>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">
                                            أرسل رسالة
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
