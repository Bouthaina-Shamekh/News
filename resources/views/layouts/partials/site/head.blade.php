<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ميتا من الصفحة نفسها إن وجدت --}}
    @stack('meta')

    {{-- fallback إذا لم تُحدد meta من الصفحة --}}
    @if (! View::hasSection('has_custom_meta'))
        @php
            $defaultTitle = 'مارينا بوست';
            $defaultDescription = 'مارينا بوست هي منصة إعلامية رقمية متنوعة، فلسطينية الهوى، عربية الامتداد...';
            $defaultKeywords = 'مارينا بوست, أخبار, عاجلة, الإعلام, التكنولوجيا';
            $defaultOgImage = secure_url('asset/img/extra/logo.png');
            $defaultUrl = url()->current();
        @endphp

        <title>{{ $defaultTitle }}</title>
        <meta name="description" content="{{ $defaultDescription }}">
        <meta name="keywords" content="{{ $defaultKeywords }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ $defaultUrl }}">

        <!-- Open Graph -->
        <meta property="og:title" content="{{ $defaultTitle }}">
        <meta property="og:description" content="{{ $defaultDescription }}">
        <meta property="og:image" content="{{ $defaultOgImage }}">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="{{ $defaultUrl }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="ar_AR">
        <meta property="og:site_name" content="مارينا بوست">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $defaultTitle }}">
        <meta name="twitter:description" content="{{ $defaultDescription }}">
        <meta name="twitter:image" content="{{ $defaultOgImage }}">
        <meta name="twitter:url" content="{{ $defaultUrl }}">
    @endif
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
