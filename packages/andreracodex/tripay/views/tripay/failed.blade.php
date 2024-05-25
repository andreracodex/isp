<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="{{ $profile[42]->value }}" />
    <meta name="keywords" content="{{ $profile[43]->value }}" />
    <meta name="author" content="{{ $profile[5]->value }}" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset($profile[2]->value) }}" type="image/x-icon" />

    <!-- [Page specific CSS] start -->
    <link href="{{ asset('/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- [Page specific CSS] end -->
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('/fonts/inter/inter.css') }}" id="main-font-link" />

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('/css/style-preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/landing.css') }}" />
</head>

<body class="landing-page">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>



    <div class="container" style="margin-top: 100px;">
        <div class="card social-profile">
            <img src="{{ asset('/images/application/img-profile-cover.jpg') }}" alt="" class="w-100 card-img-top">
        </div>
        <h1>404</h1>
        <h3>Ooops, {{ $errors }}</h3>

        <h3><a href="{{ route('tripay.merchant') }}">Back To Channel Payment</a></h3>

    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Required Js -->
    <script src="{{ asset('/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
    <script src="{{ asset('/js/plugins/feather.min.js') }}"></script>

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/Jarallax.js') }}"></script>
    <!-- [Page Specific JS] end -->
    @include('tripay::base.header')
    @include('tripay::base.footer')
</body>

</html>
