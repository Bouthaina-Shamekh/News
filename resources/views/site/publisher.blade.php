<x-site-layout>
    @php
    $title = 'title_' . app()->getLocale();
    $name = 'name_' . app()->getLocale();
    @endphp
    @push('styles')
    <style>
        .news-title {
            display: inline-block !important;
            max-width: 395px !important;
            white-space: nowrap;
            overflow: clip;
            text-overflow: ellipsis;
            text-align: start !important;
        }

        .AdjustRow li {
            padding: 6px 14px !important;
        }

        .h4 {
            text-align: start !important;
        }

    </style>
    @endpush
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb" style="direction: rtl">
                <li>
                    <a href="{{ route('site.index')}}" class="btn-link"><i class="fa fm fa-home"></i> الرئيسية</a>
                </li>
                <li class="active">
                    <span>{{$publisher->name ?? ''}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row" id="contentRow">
                <div class="main--content col-md-12" data-sticky-content="true">
                    <div class="sticky-content-inner" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                        <div class="widget">
                            <div class="profile--widget">
                                <div class="contributor--item style--1">
                                    <div class="img"> <img src="{{ asset('storage/' . $publisher->img) }}" alt="" data-rjs="2"> </div>
                                    <div class="name">
                                        <h3 class="name" style="text-align: center;color:red;">{{$publisher->name ?? ''}}</h3>
                                    </div>
                                    <div class="desc">
                                        <p>{{$publisher->description ?? ''}}</p>
                                    </div>
                                    <div class="action"> <a href="{{ route('site.publisherNews', $publisher->id) }}" class="btn btn-default">
                                            اخبار الناشر
                                        </a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div style="position: absolute; left: 0px; top: 0px; transition: all; width: 1180px; height: 269px;"></div>
                            </div>
                            <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-site-layout>
