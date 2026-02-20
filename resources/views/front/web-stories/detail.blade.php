<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $category->meta_title ?? '' }}</title>
    <link rel="canonical" href="/web-stories">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <!-- meta details -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="{{ $seoData['title'] ?? 'Default title' }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Default description' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'Default keywords' }}">
    <link rel="canonical" href="{{ url()->full() }}" />
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 7s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
    <noscript><style amp-boilerplate>body{-webkit-animation:none;animation:none}</style></noscript>
    <script defer async src="https://cdn.ampproject.org/v0.js"></script>
    <script defer async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script defer async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
        amp-story {
            font-family: 'Oswald', sans-serif;
            color: #fff;
        }
        amp-story-page {
            background-color: #000;
        }
        h1 {
            font-weight: bold;
            font-size: 2.5em;
            line-height: 1.2;
            text-align: center;
            margin: 0 16px;
        }
        .text-overlay {
            display: inline-block;
            color: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            text-align: center;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1.5s ease-in forwards;
        }
        p {
            font-size: 1.2em;
            line-height: 1.5;
            margin: 0;
        }
        .credit {
            font-size: 1em;
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
        .mobile-link {
            color: white;
            text-decoration: none;
        }
        @keyframes zoomOutSlow {
            0% {
                transform: scale(1.3);
            }
            100% {
                transform: scale(1.1);
            }
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .zoom-animation {
            animation: zoomOutSlow 9s ease-in-out forwards;
        }
    </style>
</head>
<body>
    <amp-story standalone 
    title="Web Stories" 
    publisher="Your Website" 
    publisher-logo-src="/path-to-logo.png" 
    poster-portrait-src="/path-to-cover.jpg">

    @foreach ($stories as $story)
    <amp-story-page id="page-{{ $story->id }}" auto-advance-after="7s">
        <!-- Image Layer -->
        <amp-story-grid-layer template="fill">
            <amp-img 
                src="{{ asset('uploads/web-stories/' . $story->image) }}" 
                width="720" height="1280" 
                layout="fill" 
                object-fit="contain"
                class="zoom-animation"
                alt="{{ @$story->title ?? 'Story Title' }}">
            </amp-img>
        </amp-story-grid-layer>

        <!-- Logo Layer -->
        <amp-story-grid-layer template="vertical" class="top-logo">
            <amp-img src="{{ asset(uploadsDir('front') . $siteSettings->logo) }}" 
                     width="80" height="40" 
                     layout="fixed" 
                     class="publisher-logo" 
                     alt="Publisher Logo">
            </amp-img>
        </amp-story-grid-layer>

        <!-- Text Layer -->
        <amp-story-grid-layer template="vertical" class="bottom-text" 
            style="background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.7) 20%, rgba(0,0,0,0) 70%); padding:16px;">
            <span class="text-overlay" style="animation-delay:0.5s;">
                @if ($loop->last && $category->reference_link)
                <p>
                    <a class="text-decoration-none text-dark" href="{{ $category->reference_link }}">
                        View More
                    </a>
                </p>
            @endif
                @if ($story->description)
                    <p>{{ $story->description }}</p>
                @endif
                @if ($story->credit_by)
                    <p class="credit">By: {{ $story->credit_by }}</p>
                @endif
            </span>
        </amp-story-grid-layer>
    </amp-story-page>

    {{-- Insert ad page after the third story --}}
    @if ($loop->iteration == 3)
    <amp-story-page id="ad-page-1" auto-advance-after="7s">
        <amp-story-grid-layer template="fill">
            <amp-ad width="300" height="250"
                type="adsense"
                data-ad-client="ca-pub-2933454440337038"
                data-ad-slot="1426680621">
            </amp-ad>
        </amp-story-grid-layer>
    </amp-story-page>
    @endif

    @endforeach

    {{-- Insert an ad page after all stories --}}
    <amp-story-page id="ad-page-2" auto-advance-after="7s">
        <amp-story-grid-layer template="fill">
            <amp-ad width="300" height="250"
                type="adsense"
                data-ad-client="ca-pub-2933454440337038"
                data-ad-slot="1426680621">
            </amp-ad>
        </amp-story-grid-layer>
    </amp-story-page>

    <!-- Bookend -->
    <amp-story-bookend src="/path-to-your-bookend.json" layout="nodisplay"></amp-story-bookend>
</amp-story>

</body>
</html>