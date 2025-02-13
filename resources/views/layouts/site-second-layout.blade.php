@include('layouts.partials.site.head')
    <!-- Header -->
    @include('layouts.partials.site.headerSecond')

    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                {{$breadcrumb ?? ''}}
            </ul>
        </div>
    </div>

    {{$slot}}

    <!-- Start Modals -->
    @include('layouts.partials.site.modal')
    <!-- End Modal -->

    <!-- صفحة مهمة عند فتح بعض الحركات -->
    <div id="fullScreen" class="absolute top-0 left-0 bg-black/50 w-full h-full hidden" style="z-index: 1000;">
    </div>

@include('layouts.partials.site.footer')
