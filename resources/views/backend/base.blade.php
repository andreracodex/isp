<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>GNet | @yield('title')</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @auth
        <meta name="description" content="{{ $profile[42]->value }}" />
        <meta name="keywords" content="{{ $profile[43]->value }}" />
        <meta name="author" content="{{ $profile[5]->value }}" />
        <!-- [Favicon] icon -->
        <link rel="icon" href="{{ asset($profile[2]->value) }}" type="image/x-icon">

    @endauth
    <link rel="icon" href="{{ asset('/images/favicon.ico')}}" type="image/x-icon">
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
    <link rel="stylesheet" href="{{ asset('/css/uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins/notifier.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins/select2.min.css') }}" />
    @auth
    <link rel="stylesheet" href="{{ asset('/css/plugins/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/plugins/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/plugins/buttons.bootstrap5.min.css') }}">
    @endauth
    @stack('styles')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    {{-- Load Component if Auth --}}
    @auth
        @include('backend.components.sidebar')
        @include('backend.components.header')
        <!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pc-content">
                @yield('bread')
                <!-- [ Main Content ] start -->
                @yield('isi')

                <!-- [ Main Content ] end -->
            </div>
        </div>
        @include('backend.components.footer')
    @endauth

    @yield('contentlogin')
    <!-- [ Main Content ] end -->

    @include('backend.components.prefences')

    <!-- Required Js -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
    <script src="{{ asset('/js/pcoded.js') }}"></script>
    <script src="{{ asset('/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('/js/component.js') }}"></script>
    <script src="{{ asset('/js/plugins/notifier.js') }}"></script>
    <script src="{{ asset('/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/select2.min.js') }}"></script>
    @include('flash')
    @auth
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener(
                    'load',
                    function() {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('needs-validation');
                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener(
                                'submit',
                                function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                },
                                false
                            );
                        });
                    },
                    false
                );
            })();
        </script>
        <script src="{{ asset('/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/buttons.print.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/pdfmake.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/jszip.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/vfs_fonts.js') }}"></script>
        <script src="{{ asset('/js/plugins/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/dataTables.checkboxes.min.js') }}"></script>
    @endauth
    @stack('script')
</body>
<!-- [Body] end -->

</html>
