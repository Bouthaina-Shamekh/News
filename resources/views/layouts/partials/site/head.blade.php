<!DOCTYPE html>
<html dir="ltr" lang="ar">
    <head>
        <meta charset="utf-8">
        <title>مارينا بوست </title>
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
    </head>
    @php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
    @endphp
<body onload="document.body.style.backgroundColor = 'white';document.body.style.backgroundImage = 'url()';">


