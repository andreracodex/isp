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

        <h1>Payment Details</h1>
        <ul>
            <li>Reference: {{ $data['reference'] }}</li>
            <li>Merchant Ref: {{ $data['merchant_ref'] }}</li>
            <li>Payment Selection Type: {{ $data['payment_selection_type'] }}</li>
            <li>Payment Method: {{ $data['payment_method'] }}</li>
            <li>Payment Name: {{ $data['payment_name'] }}</li>
            <li>Customer Name: {{ $data['customer_name'] }}</li>
            <li>Customer Email: {{ $data['customer_email'] }}</li>
            <li>Customer Phone: {{ $data['customer_phone'] }}</li>
            <li>Callback URL: {{ $data['callback_url'] }}</li>
            <li>Return URL: {{ $data['return_url'] }}</li>
            <li>Amount: {{ $data['amount'] }}</li>
            <li>Merchant Fee: {{ $data['fee_merchant'] }}</li>
            <li>Customer Fee: {{ $data['fee_customer'] }}</li>
            <li>Total Fee: {{ $data['total_fee'] }}</li>
            <li>Amount Received: {{ $data['amount_received'] }}</li>
            <li>Pay Code: {{ $data['pay_code'] }}</li>
            <li>Status: {{ $data['status'] }}</li>
            <li>Expired Time: {{ $data['expired_time'] }}</li>
            <li>Order Items:</li>
            <ul>
                @foreach($data['order_items'] as $item)
                    <li>
                        <ul>
                            <li>SKU: {{ $item['sku'] }}</li>
                            <li>Name: {{ $item['name'] }}</li>
                            <li>Price: {{ $item['price'] }}</li>
                            <li>Quantity: {{ $item['quantity'] }}</li>
                            <li>Subtotal: {{ $item['subtotal'] }}</li>
                            <li>Product URL: {{ $item['product_url'] }}</li>
                            <li>Image URL: {{ $item['image_url'] }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </ul>

    </div>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Required Js -->
    <script src="{{ asset('/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
    <script src="{{ asset('/js/pcoded.js') }}"></script>
    <script src="{{ asset('/js/plugins/feather.min.js') }}"></script>

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/Jarallax.js') }}"></script>
    <script>
        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener('scroll', function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
            } else if (cOst > ost) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
                document.querySelector('.navbar').classList.remove('default');
            } else {
                document.querySelector('.navbar').classList.add('default');
                document.querySelector('.navbar').classList.remove('top-nav-collapse');
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: 'animated'
        });
        wow.init();

        // slider start
        $('.screen-slide').owlCarousel({
            loop: true,
            margin: 30,
            center: true,
            nav: false,
            dotsContainer: '.app_dotsContainer',
            URLhashListener: true,
            items: 1
        });
        $('.workspace-slider').owlCarousel({
            loop: true,
            margin: 30,
            center: true,
            nav: false,
            dotsContainer: '.workspace-card-block',
            URLhashListener: true,
            items: 1.5
        });
        // slider end
        // marquee start
    </script>
    <!-- [Page Specific JS] end -->
    @include('tripay::header')
    @include('tripay::footer')
</body>

</html>
