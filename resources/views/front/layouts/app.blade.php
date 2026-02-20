<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (trim($__env->yieldContent('title')))
            {{ html_entity_decode(trim($__env->yieldContent('title'))) . ' - ' . now()->format('jS F Y') }}
        @else
            Softliee - {{ now()->format('Y-m-d') }}
        @endif
    </title>

    @if ($siteSettings->favicon && file_exists(uploadsDir('front') . $siteSettings->favicon))
        <link rel="icon" type="image/x-icon" href="{{ asset(uploadsDir('front') . $siteSettings->favicon) }}" />
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/front/images/favicon.ico') }}" />
    @endif

    <!-- Preconnect to external resources -->
    <!-- <link rel="preconnect" href="https://kit.fontawesome.com">
    <link rel="preconnect" href="https://pagead2.googlesyndication.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com"> -->

    <!-- Combined & minified CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/utils.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/additional.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <!-- Defer or async JavaScript to reduce render blocking -->
    <script defer src="https://kit.fontawesome.com/8672e0d49a.js" crossorigin="anonymous"></script>
    <script defer src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2933454440337038" crossorigin="anonymous"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="{{ $seoData['title'] ?? 'Default title' }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Default description' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'Default keywords' }}">
    <link rel="canonical" href="{{ url()->full() }}" />



    <!-- Optional: Inline Critical CSS here if needed -->

    @yield('header')
    @if (@$siteSettings->header_script && $siteSettings->header_script != '')
        {!! $siteSettings->header_script !!}
    @endif

    @yield('css')
</head>
<body>
    @include('front.layouts.partials.header')

    <div class="container-fliud">
        @yield('content')
        <div class="overlay" id="overlay" onclick="hideOverlay()"></div>
    </div>

    @if (Route::currentRouteName() !== 'phone-finder')
        <!-- Sticky Footer for Ads -->
        <div id="stickyFooter" class="fixed-bottom d-flex justify-content-center align-items-center p-0 m-0" style="background: transparent;">
            <span class="position-absolute text-light p-1 advertisement_text" style="top: -20px; left: 0; font-size: 8px; background: black; padding-right: 8px;">
                Advertisement
            </span>
            <span id="closeFooter" class="position-absolute bg-dark text-light d-flex align-items-center justify-content-center" style="top: -25px; right: 0; width: 24px; height: 24px; border-radius: 50%; cursor: pointer;">&times;</span>
            <div class="position-relative ad-container" id="adContainer" style="width: 100%; max-width: 700px; display: flex; justify-content: center; align-items: center;">
                <!-- Ad will be injected here -->
            </div>
        </div>
        <script>
            // Adjust ad visibility based on viewport size
            function adjustAdVisibility() {
                const adContainer = document.getElementById('adContainer');
                const isMobile = window.innerWidth <= 768;
                adContainer.innerHTML = ''; // clear previous ad

                const ad = document.createElement('ins');
                ad.className = 'adsbygoogle';
                ad.setAttribute('data-ad-client', 'ca-pub-2933454440337038');

                if (isMobile) {
                    ad.setAttribute('data-ad-slot', '6493556933');
                    ad.style.width = '300px';
                    ad.style.height = '50px';
                    document.getElementById('stickyFooter').style.height = '50px';
                } else {
                    ad.setAttribute('data-ad-slot', '6702463586');
                    ad.style.width = '728px';
                    ad.style.height = '90px';
                }

                ad.style.display = 'inline-block';
                adContainer.appendChild(ad);
                (adsbygoogle = window.adsbygoogle || []).push({});
            }
            adjustAdVisibility();
            window.addEventListener('resize', adjustAdVisibility);
        </script>
        {{-- {!! @$siteSettings->sticky_google_script ?? '' !!} --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#closeFooter').on('click', function() {
                    setTimeout(function() {
                        document.body.style.paddingBottom = '0px';
                        $('#stickyFooter').slideUp('slow', function() {
                            $(this).css('display', 'none');
                        });
                    }, 1000);
                });
            });
        </script>
    @endif

    @if (!in_array(Route::currentRouteName(), [
            'home','blogs','contact','privacy-policy','terms-conditions','login','register','product.pictures','admin.auth.login'
        ]))
        {!! @$siteSettings->bottom_google_script ?? '' !!}
    @endif

    @if (!Request::routeIs('phone-finder'))
        @include('front.layouts.partials.footer')
    @endif

    <!-- Load remaining JS files with defer -->
    <script defer src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script defer src="https://static.elfsight.com/platform/platform.js" async></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script defer src="{{ asset('assets/admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script defer src="{{ asset('assets/admin/app-assets/js/scripts/extensions/toastr.js') }}"></script>
    @yield('script-js')
    @include('admin.partials.errors')
    @if (@$siteSettings->body_script && $siteSettings->body_script != '')
        {!! $siteSettings->body_script !!}
    @endif

    <!-- Lazy load images using Intersection Observer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lazyImages = document.querySelectorAll("img.lazy");
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) { img.src = img.dataset.src; }
                        if (img.dataset.srcset) { img.srcset = img.dataset.srcset; }
                        img.classList.remove("lazy");
                        observer.unobserve(img);
                    }
                });
            }, { rootMargin: "200px", threshold: 0 });
            lazyImages.forEach(img => observer.observe(img));
        });
    </script>

    <!-- header js -->
    <script>
        $(document).ready(function() {
            const $overlay = $('#overlay');

            // AJAX request for mobile search
            $('.searchInput2').on('input', function() {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('search.product-responsive') }}", // Laravel route for mobile search
                        method: 'GET',
                        data: {
                            search: query
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                $('.searchinput2dropdown').html(''); // Clear existing results
                                $('.searchinput2dropdown').append(response.products); // Add new results
                                $('.searchinput2dropdown').removeClass('d-none');
                                $overlay.show();
                            } else if (response.status === 0) {
                                $('.searchinput2dropdown').html(`
                                    <div class="card bg-light text-center mb-0 rounded-0 px-0 mx-0 border-0 d-flex justify-content-center align-items-center" style="width: 100vw; height: 40px;">
                                        <h5 class="card-title fw-bold mb-0 text-dark fs-6 fw-semibold">Records not found!</h5>
                                    </div>
                                `);
                                $overlay.show();
                            }
                        },
                        error: function() {
                            console.log('Error fetching mobile search results');
                        }
                    });
                } else {
                    $('.searchinput2dropdown').addClass('d-none');
                    $overlay.hide();
                }
            });

            // Hide the dropdown when clicked outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.searchInput2').length && !$(e.target).closest(
                        '.searchinput2dropdown').length) {
                    $('.searchinput2dropdown').addClass('d-none');
                    $overlay.hide();
                }
            });
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof lightbox !== "undefined") {
                lightbox.option({
                    'resizeDuration': 200,
                    'wrapAround': true,
                    'albumLabel': "Image %1 of %2",
                    'fadeDuration': 200,
                    'imageFadeDuration': 200
                });
            } else {
                console.error("Lightbox2 is not loaded.");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <script>
        var typed = new Typed('.searchInput', {
            strings: ['Search your Phone...', 'Mobile Description...',
                'Search Your Mobile Price...'
            ],
            typeSpeed: 50,
            backSpeed: 25,
            startDelay: 500,
            backDelay: 1500,
            loop: true,
            attr: 'placeholder',
            bindInputFocusEvents: true
        });

        var typed2 = new Typed('.searchInput2', {
            strings: ['Search your Phone...', 'Mobile Description...',
                'Search Your Mobile Price...'
            ],
            typeSpeed: 50,
            backSpeed: 25,
            startDelay: 500,
            backDelay: 1500,
            loop: true,
            attr: 'placeholder',
            bindInputFocusEvents: true
        });

        function showOverlay() {
            const overlay = document.getElementById('overlay');
            const hoverBox = document.getElementById('hover-box');

            // Show the overlay immediately
            overlay.style.display = 'block';

            // Initially hide the hover-box and then animate
            hoverBox.style.display = 'block';
            setTimeout(() => {
                hoverBox.style.opacity = '1';
                hoverBox.style.transform = 'translateY(0)';
            }, 10); // Small delay to trigger animation after display block
        }

        function hideOverlay() {
            const overlay = document.getElementById('overlay');
            const hoverBox = document.getElementById('hover-box');

            // Animate out the hover-box first
            hoverBox.style.opacity = '0';
            hoverBox.style.transform = 'translateY(20px)'; // Slide up

            // After the animation finishes, hide the elements
            setTimeout(() => {
                overlay.style.display = 'none';
                hoverBox.style.display = 'none';
            }, 300); // Timeout should match the CSS transition duration
        }

        // Select the mobile navbar element
        const mobileNavbar = document.querySelector('.mobile-navbar');

        // Variable to keep track of scroll position
        let lastScrollTop = 0;

        // Function to handle scroll event
        function handleScroll() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            // Check if scrolled more than 100px
            if (currentScroll > 100) {
                // Scroll down
                if (currentScroll > lastScrollTop) {
                    mobileNavbar.classList.add('mobile-navbar-hidden');
                } else {
                    // Scroll up
                    mobileNavbar.classList.remove('mobile-navbar-hidden');
                }
            } else {
                // Less than 100px, always show the navbar
                mobileNavbar.classList.remove('mobile-navbar-hidden');
            }

            // Update last scroll position
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }

        // Add event listener for scroll events
        window.addEventListener('scroll', handleScroll);
    </script>

    <script>
        $(document).ready(function() {
            $('#toggle-more').on('click', function(event) {
                // Prevent the dropdown from closing
                event.stopPropagation();

                if ($('.brand-item.d-none').length > 0) {
                    $('.brand-item.d-none').show().removeClass('d-none');
                } else if ($('.toggle-brand').length > 0) {
                    $('.toggle-brand').hide().addClass('d-none');
                }

                // Change the text of the toggle link
                if ($(this).text() === 'Show More...') {
                    $(this).text('Show Less...');
                } else {
                    $(this).text('Show More...');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const $searchInput = $('#searchInput');
            const $tabsContainer = $('#tabsContainer');
            const $overlay = $('#overlay');

            // Show or hide tabsContainer based on search input
            $searchInput.on('input', function() {
                const query = $searchInput.val().toLowerCase();
                if (query.length !== 0) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // processing ajax request    
                    $.ajax({
                        url: "{{ route('search.product') }}",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: query
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                $tabsContainer.removeClass('d-none');
                                $overlay.show();

                                $('.header-search-products').html('');
                                $('.header-search-products').html(response.products);
                            } else if (response.status == 0) {
                                $('.header-search-products').html('');
                                $('.header-search-products').html(`
                                        <div class="card text-center mb-0 rounded-0 px-0 border-0 mt-0 d-flex justify-content-center align-items-center" style="width: 100%; height: 40px;">
                                            <h5 class="card-title fw-bold mb-0 text-dark fs-6 fw-semibold">
                                                Records not found!
                                            </h5>
                                        </div>
                                    `);
                            } else if (response.status == 2) {
                                toastr.error("Something went wrong please try again later.",
                                    'Error!', {
                                        "showMethod": "slideDown",
                                        "hideMethod": "slideUp",
                                        timeOut: 2000
                                    });
                            } else {
                                toastr.error("Something went wrong please try again later.",
                                    'Error!', {
                                        "showMethod": "slideDown",
                                        "hideMethod": "slideUp",
                                        timeOut: 2000
                                    });
                            }
                        }
                    });
                } else {
                    $tabsContainer.addClass('d-none');
                    // $overlay.hide();
                }
            });

            // Show tabsContainer when the search input is focused and has no query
            $searchInput.on('focus', function() {
                if ($searchInput.val().length === 0) {
                    $tabsContainer.removeClass('d-none');
                    $overlay.show();
                }
            });

            // Hide tabsContainer when clicking outside of searchInput and tabsContainer
            $(document).on('click', function(event) {
                const isClickInsideSearchInput = $searchInput.is(event.target);
                const isClickInsideTabsContainer = $tabsContainer.is(event.target) || $tabsContainer.has(event
                    .target).length > 0;

                // Only hide tabsContainer if the click is outside both searchInput and tabsContainer
                if (!isClickInsideSearchInput && !isClickInsideTabsContainer) {
                    $tabsContainer.addClass('d-none');
                    // $overlay.hide();
                }
            });

            // Prevent hiding tabsContainer if clicking inside searchInput or tabsContainer
            $tabsContainer.on('click', function(event) {
                event.stopPropagation();
            });

            $searchInput.on('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>

    <script>
        // Define route URL outside of the function
        const searchRoute = `{{ route('search.mobile') }}`;

        // search mobile
        $(document).on('keydown', '.searchInput', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                performSearch();
            }
        });

        $('.searchButton').on('click', function() {
            performSearch();
        });

        function performSearch() {
            const searchInput = $('.searchInput').val();

            if (searchInput != '') {
                window.location.href = `${searchRoute}?name=${encodeURIComponent(searchInput)}`;
            }
        }
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSHNSR65"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KSHNSR65');</script>
    <!-- End Google Tag Manager -->
</body>
</html>
