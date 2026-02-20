<div class="container-fliud d-none d-lg-block nav-shadow bg-theme">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class=" bg-theme py-2">
                <div class="container d-flex gap-5 align-items-center justify-content-center">
                    @if ($siteSettings->logo && file_exists(uploadsDir('front') . $siteSettings->logo))
                    <a class="" href="{{ route('home') }}">
                        <img src="{!! asset(uploadsDir('front') . $siteSettings->logo) !!}" alt="logo" class="img-fluid"
                            width="140" height="60">
                    </a>
                    @else
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/front/images/web-logo.svg') }}" alt="logo" class="img-fluid"
                            width="140" height="60">
                    </a>
                    @endif
                    <form class="d-flex w-100 position-relative" role="search">
                        <div class="input-group" style='z-index:1000'>
                            <input type="text" id="searchInput"
                                class="form-control searchInput p-2 px-3 form-placeholder text-dark fw-semibold w-75 focus-ring"
                                placeholder="" aria-label="Search">

                            <button
                                class="btn bg-light text-black px-3 py-2 form-placeholder border-0 d-flex justify-content-center align-items-center fw-bold gap-2 w-25 text-center searchButton"
                                type="button"><i class="fas fa-search"></i> Search</button>

                        </div>

                        <!-- search by mobile -->
                        <div id="tabsContainer"
                            class="row position-absolute w-75 pt-1 bg-white rounded-3 shadow-sm d-none d-flex gap-0 p-2 align-items-center pt-2 pb-2 "
                            style='margin-top: 3rem; margin-left: 0.05rem; overflow:hidden'>
                            <!-- Tab content -->
                            <div class="tab-content" id="tabsContent">
                                <div class="tab-pane fade show active " id="tab1" role="tabpanel"
                                    aria-labelledby="tab1-tab">
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <div class="d-flex flex-wrap justify-content-between gap-2 pt-0 pb-2 header-search-products"
                                            style="max-width: 1000px; margin: 0 auto; text-decoration:none;">
                                            @if (@$headerNotification && count($headerNotification) > 0)
                                            @foreach ($headerNotification as $headerSearchBarProduct)
                                            <a href="{{ route('product.details', $headerSearchBarProduct->slug) }}"
                                                class="card text-center mb-0 px-0 text-decoration-none"
                                                style="width: 130px; height: 160px; font-size:0.8rem;border: 1px solid rgba(0,0,0,0.1)">
                                                @if ($headerSearchBarProduct->image &&
                                                file_exists(public_path('uploads/products/' .
                                                $headerSearchBarProduct->image))
                                                )
                                                <img class="card-img-top p-2 mb-0"
                                                    style="object-fit: contain; height: 100px;"
                                                    src="{{ asset('uploads/products/' . $headerSearchBarProduct->image) }}"
                                                    alt="{{ $headerSearchBarProduct->alt_image }}" width='4vw'>
                                                @else
                                                <img class="card-img-top p-2 mb-0"
                                                    style="object-fit: contain; height: 100px;"
                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                    alt="placeholder image" width='4vw'>
                                                @endif
                                                <div class="card-body">
                                                    <p class="card-title  footer-link-size mb-0 text-dark fw-semibold">
                                                        {{ ucfirst($headerSearchBarProduct->name) }}</p>
                                                </div>
                                            </a>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if (@$headerNotification && count($headerNotification))
                    <div class="dropdown">
                        <!-- Notification Icon as Dropdown Toggle -->
                        <a href="javascript:void(0)" class="dropdown-toggle" id="notificationDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/front/images/notification.svg') }}" height="20"
                                alt="Notification Icon">
                        </a>

                        <div class="dropdown-overlay" id="dropdownOverlay"></div>

                        <ul class="dropdown-menu dropdown-menu-end rounded-4 mt-2"
                            aria-labelledby="notificationDropdown">
                            <!-- Example Notifications -->
                            <li class="m-0 p-0">
                                <div class="dropdown-item d-flex align-items-baseline justify-content-between">
                                    <h5 class="fw-bold pt-1 fs-6">Notifications</h5>
                                    <a href="{{ route('latest.mobiles') }}"
                                        class="text-danger d-flex align-items-baseline form-placeholder">
                                        <p>See More</p><i class="fa-solid fa-chevron-right ms-1"></i>
                                    </a>
                                </div>
                            </li>

                            @foreach ($headerNotification as $notificationProduct)
                            <li class="m-0 p-0">
                                <a class="dropdown-item p-0"
                                    href="{{ route('product.details', $notificationProduct->slug) }}">
                                    <div class="mb-1 rounded-0 shadow-sm border-0 mx-3 p-2 d-flex flex-row align-items-center position-relative"
                                        style="width: 18vw;">
                                        <!-- Image -->
                                        @if ($notificationProduct->image && file_exists(public_path('uploads/products/'
                                        . $notificationProduct->image)))
                                        <img class="img-fluid"
                                            src="{{ asset('uploads/products/' . $notificationProduct->image) }}"
                                            alt="{{ $notificationProduct->alt_image }}"
                                            style="width: 60px; object-fit: cover;">
                                        @else
                                        <img class="img-fluid"
                                            src="https://via.placeholder.com/300x100.png?text=No+Image"
                                            alt="placeholder image" style="width: 60px; object-fit: cover;">
                                        @endif


                                        <div class="card-body p-0 mx-0 d-flex flex-column justify-content-start align-items-start w-100"
                                            style='position:absolute;left:80px'>
                                            <p class="card-text form-placeholder fw-bold text-black mb-0">{{ ucfirst($notificationProduct->name) }}
                                            </p>
                                            <p class="card-text fw-semibold text-black-50 fw-semibold mb-0" style='font-size:14px;'>
                                                {!! env('CURRENCY', 'PKR') . ' ' .
                                                number_format($notificationProduct->original_price) !!}
                                            </p>
                                            <a href="{{ route('product.details', $notificationProduct->slug) }}"
                                                class="text-decoration-none mb-0">
                                                <small
                                                    class="text-danger fw-bold text-decoration-none font-sm">Read
                                                    More</small>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                    @endif

                    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('notificationDropdown');
    const overlay = document.getElementById('dropdownOverlay');

    // Toggle overlay visibility on dropdown show/hide
    dropdown.addEventListener('click', function () {
        overlay.style.display = (overlay.style.display === 'block') ? 'none' : 'block';
    });

    // Hide overlay when clicking outside the dropdown
    overlay.addEventListener('click', function () {
        overlay.style.display = 'none';
        dropdown.classList.remove('show');
        document.querySelector('.dropdown-menu').classList.remove('show');
    });
});

</script>                    
                    <div class="d-inline-block btn position-relative hover-trigger-container"
                        onmouseover="showOverlay()">
                        <h6 class="my-auto hover-trigger d-inline-block py-1">
                            @if (Auth::check())
                            <!-- User is authenticated -->
                            <span class="text-white fw-semibold">
                                <img src="{{ asset('assets/front/images/User_icon.svg') }}" height="25" alt="">
                            </span>
                            @else
                            <!-- User is not authenticated -->
                            <a href="{{ route('login') }}" class="text-decoration-none text-white fw-semibold">
                                <img src="{{ asset('assets/front/images/User_icon.svg') }}" height="25" alt="">
                            </a>
                            @endif
                        </h6>
                        <div class="pt-5 hover-box" id="hover-box">
                            <div class=" bg-light text-black rounded-4 p-3 mt-0" style="width: 275px;">
                                @if (Auth::check())
                                <!-- Authenticated user -->
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('assets/front/images/User-Web-Icon.svg') }}" alt="">
                                    <div class="d-flex flex-column">
                                        <h5 class="m-0 fw-bold">{{ Auth::user()->name }}</h5>
                                        <div class="d-flex gap-3">
                                            <a href="javascript:void(0)"
                                                class="text-decoration-none text-black-50 form-placeholder d-flex gap-2 d-none">
                                                <p class='fw-semibold'>Sign Up</p>
                                                <i class="fa-solid fa-chevron-right font-sm"
                                                    style="position:relative; top: 6px;"></i>
                                            </a>
                                            <!-- Logout Link -->
                                            <a href="javascript:void(0)" onclick='event.preventDefault();'
                                                class="text-decoration-none text-black-50 form-placeholder d-flex gap-2  d-none">
                                                <p class='fw-semibold'>Login</p>
                                                <i class="fa-solid fa-chevron-right font-sm"
                                                    style="position:relative; top: 6px;"></i>
                                            </a>

                                            <!-- Logout Form -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('POST')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class='text-decoration-none text-black-50 form-placeholder d-flex gap-2 mt-2 justify-content-between align-items-center mt-2 px-2 logout-hover py-1 pt-2 rounded-2'>
                                    <h5 class='fs-6 fw-bold mt-1'>Logout</h5><i class="fa-solid fa-chevron-right"></i>
                                </a>
                                @else
                                <!-- Unauthenticated user -->
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('assets/front/images/User-Web-Icon.svg') }}" alt="">
                                    <div class="d-flex flex-column pt-3">
                                        <h5 class="m-0 fw-bold">Welcome User</h5>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('register') }}"
                                                class="text-decoration-none text-black-50 form-placeholder d-flex gap-2">
                                                <p>Sign Up</p>
                                                <i class="fa-solid fa-chevron-right font-sm"
                                                    style="position:relative; top: 6px;"></i>
                                            </a>
                                            <a href="{{ route('login') }}"
                                                class="text-decoration-none text-black-50 form-placeholder d-flex gap-2">
                                                <p>Login</p>
                                                <i class="fa-solid fa-chevron-right font-sm"
                                                    style="position:relative; top: 6px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container pt-3 pb-1">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start align-items-center gap-2 gap-lg-0"
                            style='width:80%;'>
                            <a href="{{ route('home') }}"
                                class="text-decoration-none {{ request()->routeIs('/') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6
                                    class="fw-bold border-end {{ request()->routeIs('home') ? 'text-danger' : '' }} pe-xl-3 pe-1">
                                    Home Mobiles</h6>
                            </a>
                            <a href="{{ route('blogs') }}"
                                class="text-decoration-none {{ request()->routeIs('blogs') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6
                                    class="fw-bold border-end {{ request()->routeIs('blogs') ? 'text-danger' : '' }} px-xl-3 px-1">
                                    Tech News</h6>
                            </a>
                            <a href="{{ route('upcoming.mobiles') }}"
                                class="text-decoration-none {{ request()->routeIs('upcoming.mobiles') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6
                                    class="fw-bold border-end {{ request()->routeIs('upcoming.mobiles') ? 'text-danger' : '' }} px-xl-3 px-1">
                                    Upcoming Mobiles</h6>
                            </a>
                            <a href="{{ route('popular.mobiles') }}"
                                class="text-decoration-none {{ request()->routeIs('popular.mobiles') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6
                                    class="fw-bold border-end {{ request()->routeIs('popular.mobiles') ? 'text-danger' : '' }} px-xl-3 px-1">
                                    Popular Mobiles</h6>
                            </a>
                            <a href="{{ route('phone-finder') }}"
                                class="text-decoration-none  {{ request()->routeIs('phone-finder') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6
                                    class="fw-bold  border-end {{ request()->routeIs('phone-finder') ? 'text-danger' : '' }} px-xl-3 px-1">
                                    Phone Finder</h6>
                            </a>
                            {{-- <a href="{{ route('contact') }}"
                                class="text-decoration-none {{ request()->routeIs('contact') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6 class="fw-bold px-xl-3 px-1">Contact Us</h6>
                            </a> --}}
                            <a href="{{ route('web-stories') }}"
                                class="text-decoration-none {{ request()->routeIs('web-stories') ? 'text-danger' : 'text-dark' }} flex-grow-1">
                                <h6 class="fw-bold px-xl-3 px-1">Web Stories</h6>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center justify-content-lg-end gap-2 gap-xl-4 align-items-center"
                            style='width:15%; position: relative; top: -5px;'>
                            <a href="{{ $siteSettings->facebook }}" class="text-decoration-none align-self-center"><img
                                    src="{{ asset('assets/front/images/fb.png') }}" alt="FB" height="23"></a>
                            <a href="{{ $siteSettings->youtube }}" class="text-decoration-none align-self-center"><img
                                    src="{{ asset('assets/front/images/yt.png') }}" alt="YT" height="23"></a>
                            <a href="{{ $siteSettings->linkedin }}" class="text-decoration-none align-self-center"><img
                                    src="{{ asset('assets/front/images/in.png') }}" alt="IN" height="23"></a>
                            <a href="{{ $siteSettings->pinterest }}" class="text-decoration-none align-self-center"><img
                                    src="{{ asset('assets/front/images/P.png') }}" alt="P" height="23"></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar mobile-navbar bg-theme fixed-top d-lg-none d-block pb-0" data-bs-theme style='width:100vw'>
    <div class="container-fluid pb-2 py-1 ">
        <button class="navbar-toggler px-0 border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" style='outline: none !important;
         box-shadow: none;'>
            <img src="{{ asset('assets/front/images/menu_icon.svg') }}" alt="" width='22' height='22'>
        </button>
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/front/images/web-logo.png') }}" alt="Softliee" height='30'>
        </a>
        @if (Auth::check())
        <!-- Log Out -->
        <a class="text-decoration-none fw-bold text-white form-placeholder" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            @method('POST')
        </form>
        @else
        <a href="{{ route('login') }}">
            <img src="{{ asset('assets/front/images/User_icon.svg') }}" height="22" alt="Icon">
        </a>
        @endif
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header" style="background: #F8F8F9;">
                <div class="d-flex align-items-center w-100">
                    @if (Auth::check())
                    <!-- User Avatar -->
                    <div class="rounded-circle"
                        style="background: #FFD88D; width: 48px; height: 48px; overflow: hidden;">
                        <img src="{{ asset('assets/front/images/mobile_user.svg') }}" alt="User"
                            style="width: 100%; height: auto;">
                    </div>
                    <!-- User Info -->
                    <div class="ms-2">
                        <h6 class="fw-semibold text-dark mb-0" style="font-size: 16px;">
                            {{ ucfirst(strtok(Auth::user()->name, ' ')) }}</h6>
                        <p class="text-muted mb-0" style="font-size: 12px;">{{ Auth::user()->email }}</p>
                    </div>
                    @else
                    <h6 class="fw-semibold text-dark mb-0 fw-bold" style="font-size: 28px;">Softliee</h6>
                    @endif
                    <!-- Close Button -->
                    <button type="button" class="btn-close ms-auto me-2" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav flex-column gap-3">
                    <!-- Top Brands Section -->
                    <li class=" dropdown">
                        <a class=" dropdown-toggle d-flex align-items-center fw-semibold text-danger text-decoration-none gap-2"
                            href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/front/images/mobile_menu_brands_icon.svg') }}" alt="Icon"
                                class="me-2">
                            Top Brands
                        </a>
                        <ul id="brands-list" class="dropdown-menu border-0">
                            @foreach (@$brandsForFooter as $key => $brand)
                            <li class="brand-item {{ $key >= 5 ? 'd-none toggle-brand' : '' }}">
                                <a class="dropdown-item fw-semibold"
                                    href="{{ route('product-by.brand', $brand->slug) }}">
                                    {{ ucfirst($brand->name) }}
                                </a>
                            </li>
                            @endforeach
                            <li>
                                <a id="toggle-more" class="dropdown-item fw-semibold" href="javascript:void(0)">Show
                                    More...</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Trending Mobiles -->
                    <li>
                        <a class="d-flex align-items-center fw-semibold text-dark text-decoration-none gap-2 ps-1"
                            href="{{ route('popular.mobiles') }}">
                            <img src="{{ asset('assets/front/images/mobile_menu_trending.png') }}" alt="Icon"
                                class="me-2">
                            Popular Mobiles
                        </a>
                    </li>

                    <!-- Upcoming Mobiles -->
                    <li>
                        <a class="d-flex align-items-center fw-semibold text-dark text-decoration-none gap-2 ps-1"
                            href="{{ route('upcoming.mobiles') }}">
                            <img src="{{ asset('assets/front/images/mobile_menu_mobile_icon.svg') }}" alt="Icon"
                                class="me-2">
                            Upcoming Mobile
                        </a>
                    </li>

                    <!-- Tech News -->
                    <li>
                        <a class="d-flex align-items-center fw-semibold text-dark text-decoration-none gap-2"
                            href="{{ route('blogs') }}">
                            <img src="{{ asset('assets/front/images/mobile_menu_news_icon.svg') }}" alt="Icon"
                                class="me-2">
                            Tech News
                        </a>
                    </li>

                    <!-- Compare Phone -->
                    <li>
                        <a class="d-flex align-items-center fw-semibold text-dark text-decoration-none gap-2"
                            href="{{ route('compare-page') }}">
                            <img src="{{ asset('assets/front/images/mobile_menu_compare_icon.png') }}" alt="Icon"
                                class="me-2">
                            Compare Phone
                        </a>
                    </li>

                    <!-- Phone Finder -->
                    <li>
                        <a class="d-flex align-items-center fw-semibold text-dark text-decoration-none gap-2"
                            href="{{ route('phone-finder') }}">
                            <img src="{{ asset('assets/front/images/mobile_menu_find_icon.svg') }}" alt="Icon"
                                class="me-2">
                            Phone Finder
                        </a>
                    </li>
                    <!-- Terms and Conditions -->
                    <li>
                        <a class="text-decoration-none fw-semibold text-dark  mt-3" href="{{ route('terms-conditions') }}">Terms And Condition
                         </a>
                    </li>
                    <!-- Contact Us -->
                    <li>
                        <a class="text-decoration-none fw-semibold text-dark mt-3" href="{{ route('web-stories') }}">Web Stories
                            </a>
                    </li>
                   
                    <li>
                        <a class="text-decoration-none fw-semibold text-dark mt-3" href="{{ route('contact') }}">Contact
                            Us</a>
                    </li>

                    <!-- Advertise with Us -->
                    {{-- <li>
                        <a class="text-decoration-none fw-semibold text-dark  mt-3" href="javascript:void(0)">Advertise
                             Us</a>
                    </li> --}}
                    <!-- Privacy Policy -->
                    <li>
                        <a class="text-decoration-none fw-semibold text-dark  mt-3" href="{{ route('privacy-policy') }}">Privacy Policy
                         </a>
                    </li>

                </ul>
            </div>

        </div>
    </div>
    <div class="container-fliud bg-light p-1" style='box-shadow:0 2px 4px rgba(0,0,0,0.2);'>
        <form action="" role='search'>
            <input type="text" id="searchInput"
                class="form-control p-2 py-2 searchInput2 fw-semibold rounded-0 form-placeholder fw-semibold focus-ring"
                placeholder="Search your Mobile..." aria-label="Search" style='height:43px; color:black;'>
        </form>
    </div>
    <div class="container searchinput2dropdown d-none bg-light shadow">
        <!-- Search results will be dynamically appended here -->
    </div>
</nav>

