
@php
    $name = 'name_'.app()->currentLocale();
    $description = 'description_'.app()->currentLocale();
@endphp
@include('layouts.partials.site.head')


    {{$slot}}

    <!-- Start Modals -->
    @include('layouts.partials.site.modal')
    <!-- End Modal -->

    <!-- صفحة مهمة عند فتح بعض الحركات -->
    <div id="fullScreen" class="absolute top-0 left-0 bg-black/50 w-full h-full hidden" style="z-index: 1000;">
    </div>

@include('layouts.partials.site.footer')
