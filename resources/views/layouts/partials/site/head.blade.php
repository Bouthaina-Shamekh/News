<!DOCTYPE html>
<html dir="rtl" lang="ar">
@php
    $title = 'مارينا بوست';
    $description = 'مارينا بوست هي منصة إعلامية رقمية متنوعة، فلسطينية الهوى، عربية الامتداد، دولية الرؤية، تنطلق من قلب الواقع الفلسطيني لتعكس نبض الإنسان وقضايا الثقافة والمجتمع والتكنولوجيا والإعلام، في سياق يتجاوز الحدود الجغرافية نحو فضاء معرفي مفتوح.';
    $keywords = 'مارينا بوست, أخبار, عاجلة, احدث الأخبار, الأكثر مشاهدة, الإعلام, التكنولوجيا';
    $ogImage = asset('asset/img/extra/logo.png');
    $url = config('app.url', 'https://marenapost.com/');
@endphp
<head>
    <meta charset="utf-8">
    <title>مارينا بوست </title>
    <!-- ✅ عنوان ووصف الصفحة -->
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="robots" content="index, follow">

    <!-- ✅ Open Graph -->
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_AR">

    <!-- ✅ Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <meta name="twitter:url" content="{{ $url }}">

    {{-- styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet " href="{{ asset('assets-new/css/font-awesome.min.css') }}">
    <link rel="stylesheet " href="{{ asset('assets-new/css/bootstrap.min.css') }}">
    <link rel="stylesheet " href="{{ asset('assets-new/css/fontawesome-stars-o.min.css') }}">
    <script type="text/javascript " src="{{ asset('assets-new/assets_news_tricker/js/jquery.js') }}"></script>
    <script type="text/javascript " src="{{ asset('assets-new/assets_news_tricker/js/acmeticker.js') }}"></script>
    <link rel="stylesheet " href="{{ asset('assets-new/assets_news_tricker/css/style_news_ticker.css') }}">
    <link rel="stylesheet " href="{{ asset('assets-new/css/responsive-style.css') }}">
    <link rel="stylesheet " href="{{ asset('assets-new/css/colors/theme-color-1.css') }}" id="changeColorScheme ">
    <link rel="stylesheet " href="{{ asset('assets-new/css/output.css') }}">
    <!--   <link rel="stylesheet " href="rtl-style.css"> -->
    <script src="{{ asset('asset/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('fonts/style.css') }}">
</head>
@php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
@endphp

<body onload="document.body.style.backgroundColor = 'white';document.body.style.backgroundImage = 'url()';">
