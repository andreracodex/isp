<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="{{$profile[42]->value}}"/>
    <meta name="keywords"
        content="{{$profile[43]->value}}"/>
    <meta name="author" content="{{$profile[5]->value}}"/>

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset($profile[2]->value) }}" type="image/x-icon" />

    <!-- [Page specific CSS] start -->
    <link href="{{ asset('/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- [Page specific CSS] end -->
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('/fonts/inter/inter.css') }}" id="main-font-link" />

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
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

    @include('tripay::header')

    <div class="container" style="margin-top: 100px;">
        @if (is_array($data))

            @foreach ($data as $item)
                <div class="card mt-5">
                    <div class="card-body">
                        @if (is_array($item) && isset($item['title']) && isset($item['steps']) && is_array($item['steps']))
                            <h2 class="mt-4">{{ $item['title'] }}</h2>
                            <ul class="list-group list-group-flush product-check-list">
                                @foreach ($item['steps'] as $step)
                                    <li class="list-group-item">{!! $step !!}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="alert alert-danger">Data is not an array.</p>
        @endif
    </div>
    <hr>
    @include('tripay::footer')
</body>

</html>
