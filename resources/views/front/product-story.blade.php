<!doctype html>
<html ⚡>
<head>
    <meta charset="utf-8">
    <title>Web Stories</title>
    <link rel="canonical" href="/web-stories">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        }
        @-webkit-keyframes -amp-start {
            from { visibility: hidden; }
            to { visibility: visible; }
        }
        @keyframes -amp-start {
            from { visibility: hidden; }
            to { visibility: visible; }
        }
    </style>
    <noscript>
        <style amp-boilerplate>
            body { -webkit-animation: none; animation: none; }
        </style>
    </noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+nOP/2RpwUa0AMRZj5DDmT20n7492h9vmI+Iv0i5nQ2QMOK9FJ7uHBLn5ko+enGM0jB5vPbLlvXa1oyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style amp-custom>
        amp-story {
            font-family: 'Oswald', sans-serif;
            color: #fff;
        }
        amp-story-page {
            background-color: #ffffff;
        }
        .text-overlay {
            display: inline-block;
            color: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            text-align: center;
            margin: 0 auto;
            opacity: 0;
            animation: fadeInUp 1.5s ease-in forwards;
        }
        .text-overlay a {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            padding: 8px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        p {
            font-size: 1.8em;
            line-height: 1.5;
            margin: 0;
        }
        .credit {
            font-size: 1.0em;
            color: #ccc;
            text-align: center;
            margin: 8px 16px;
        }
        amp-story-grid-layer.bottom-text {
            align-content: end;
            padding: 16px;
        }
        amp-story-grid-layer.top-logo {
            align-content: start;
            padding: 16px;
        }
        .publisher-logo {
            width: 100px;
            height: auto;
        }
        @keyframes zoomOutSlow {
            0% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        .zoom-out-animation {
            animation: zoomOutSlow 7s ease-in-out forwards;
        }
    </style>
</head>
<body>
    <!-- AMP Story -->
    <amp-story standalone title="Web Stories" publisher="Your Website" publisher-logo-src="{{ asset(uploadsDir('front') . $siteSettings->logo) }}" poster-portrait-src="/path-to-cover.jpg">

        <!-- Product Page -->
        <amp-story-page id="page-{{ $product->id }}" auto-advance-after="7s">
            <!-- Publisher Logo -->
            <amp-story-grid-layer template="vertical" class="top-logo">
                <amp-img src="{!! asset(uploadsDir('front') . $siteSettings->logo) !!}" 
                         width="80" height="40" 
                         layout="fixed" 
                         class="publisher-logo" 
                         alt="Publisher Logo">
                </amp-img>
            </amp-story-grid-layer>

            <!-- Product Image with Zoom-Out Effect -->
            <amp-story-grid-layer template="fill">
                <amp-img src="{{ asset('uploads/products/' . $product->image) }}" 
                         width="720" height="1280" 
                         layout="fill" 
                         object-fit="contain" 
                         class="zoom-out-animation" 
                         alt="{{ $product->name }}">
                </amp-img>
            </amp-story-grid-layer>

            <!-- Product Name and Description -->
            <amp-story-grid-layer template="vertical" class="bottom-text">
                <span class="text-overlay">
                    @if ($product->name)
                        <p>{{ $product->name }}</p>
                    @endif
                </span>
            </amp-story-grid-layer>
        </amp-story-page>

        <!-- Dynamic Product Galleries -->
        @foreach ($product->galleries as $index => $gallery)
            <amp-story-page id="page-{{ $gallery->id }}" auto-advance-after="7s">
                <!-- Publisher Logo -->
                <amp-story-grid-layer template="vertical" class="top-logo">
                    <amp-img src="{!! asset(uploadsDir('front') . $siteSettings->logo) !!}" 
                             width="80" height="40" 
                             layout="fixed" 
                             class="publisher-logo" 
                             alt="Publisher Logo">
                    </amp-img>
                </amp-story-grid-layer>

                <!-- Gallery Image with Zoom-Out Effect -->
                <amp-story-grid-layer template="fill">
                    <amp-img src="{{ asset('uploads/products/' . $gallery->image) }}" 
                             width="720" height="1280" 
                             layout="fill" 
                             object-fit="contain" 
                             class="zoom-out-animation" 
                             alt="{{ $product->name }}">
                    </amp-img>
                </amp-story-grid-layer>

                <!-- Gallery Text -->
                <amp-story-grid-layer template="vertical" class="bottom-text"
                    style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3) 30%, rgba(0, 0, 0, 0) 50%);">
                    <span class="text-overlay">
                        @if ($product->name)
                            <p class="fw-bolder">{{ $product->name }}</p>
                        @endif
                        @if ($product->brand->name)
                            <p class="credit">
                                @if ($loop->last)
                                    <a href="{{ @$product->brand->reference_link }}">
                                        {{ @$product->brand->name }}<i class="fa fa-tag"></i>
                                    </a>
                                @else
                                    <span style="color:#fff">Reference By {{ @$product->brand->name }}</span>
                                @endif
                            </p>
                        @endif
                    </span>
                </amp-story-grid-layer>
            </amp-story-page>
        @endforeach

        <!-- Bookend -->
        <amp-story-bookend src="/path-to-your-bookend.json" layout="nodisplay"></amp-story-bookend>
    </amp-story>
</body>
</html>