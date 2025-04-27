<!doctype html>
<html lang="en" class="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" dir="ltr" data-pc-theme_contrast="" data-pc-theme="light">
<!-- [Head] start -->

<head>
    <title>{{$title}}</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <link href="{{asset('assets-dashboard/css/plugins/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('assets-dashboard/images/favicon.svg')}}" type="image/x-icon" />
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/inter/inter.css')}}" id="main-font-link" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/phosphor/duotone/style.css')}}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/tabler-icons.min.css')}}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/feather.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/fontawesome.css')}}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/fonts/material.css')}}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/style.css')}}" id="" />

    <style>
        .offcanvas.offcanvas-end {
            width: 35%;
        }
    </style>
    @stack('styles')


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
            <div
                class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 transition-[transform_0.2s_linear] origin-left animate-[2.1s_cubic-bezier(0.65,0.815,0.735,0.395)_0s_infinite_normal_none_running_loader-animate]">
            </div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>


 <script>
    @auth
   var JSvar = "<?= Auth::user()->id?>";
    @endauth
       // Enable pusher logging - don't include this in production
       Pusher.logToConsole = true;

    //    var pusher = new Pusher('4e7b4215841c9ad639ad', {
    //      cluster: 'mt1'
    //    });

    var pusher = new Pusher('4e7b4215841c9ad639ad', {
         cluster: 'mt1'
       });

       var channel = pusher.subscribe('contact');
       channel.bind('notify', function(data) {


            // alert(data.user_id);
            if(data.user_id == JSvar){

           $("#notifications_count").load(window.location.href + " #notifications_count");
            $.get(window.location.href, function(response) {
               var updatedContent = $(response).find('#unread').html();

               // Update the #unread div with the fetched content
               $("#unread").html(updatedContent);

             });
            }else{

           }


       });



     </script>
