<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8" />
    <title>مارينا بوست</title>
    <link rel="stylesheet " href="{{ asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet " href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet " href="{{ asset('assets/css/fontawesome-stars-o.min.css') }}" />
    <script type="text/javascript " src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript " src="{{ asset('assets/js/acmeticker.js') }}"></script>
    <link rel="stylesheet " href="{{ asset('assets/css/style_news_ticker.css') }}" />
    <link rel="stylesheet " href="{{ asset('assets/css/responsive-style.css') }}" />
    <link rel="stylesheet " href="{{ asset('assets/css/colors/theme-color-1.css') }}" id="changeColorScheme" />
    <link rel="stylesheet " href="{{ asset('assets/css/output.css') }}" />
    <!-- <link rel="stylesheet " href="rtl-style.css"> -->
    <link rel="stylesheet " href="{{ asset('assets/css/rtl-style.css') }}" disabled id="changeDirection">
    <style>
        .text {
            display: -webkit-box !important;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
@php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
@endphp

<body onload="document.body.style.backgroundColor = 'white';document.body.style.backgroundImage = 'url()';">
