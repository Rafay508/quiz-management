
<footer class='pf-hide'>
    <!-- Footer Top -->
    <div class="bg-black text-white px-5 pt-4 pt-md-0 p-md-1 ">
        <div class="container px-md-4">
            <div class="row p-md-5 pb-md-3">
                <!-- Logo and Description -->
                <div class="col-12 col-md-3 mb-md-3 mb-0 d-none d-md-block">
                    @if ($siteSettings->logo && file_exists(uploadsDir('front') . $siteSettings->logo))
                        <img src="{!! asset(uploadsDir('front') . $siteSettings->logo) !!}" alt="logo" class="img-fluid" width="140" height="60">
                    @else
                        <img src="{{ asset('assets/front/images/web-logo.svg') }}" alt="logo" class="img-fluid" width="140" height="60">
                    @endif
                    <p class="fw-light pt-3 form-placeholder">
                        {{ $siteSettings->footer_sentence }}
                    </p>
                </div>

                <!-- Footer Links -->
                <div class="col-12 col-md-9">
                    <div class="row">
                        <!-- Softliee Links -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0  d-none d-md-block">
                            <h3 class="h6">Softliee</h3>
                            <ul class="list-unstyled d-md-block d-flex flex-column gap-2">
                                <li class="mt-1">
                                    <a href="{{ route('blogs') }}"
                                        class="text-white text-capitalize text-decoration-none fw-light form-placeholder"> Our Blog</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('contact') }}"
                                        class="text-white text-capitalize text-decoration-none fw-light form-placeholder">Contact Us</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('contact') }}"
                                        class="text-white text-capitalize text-decoration-none fw-light form-placeholder">Advertise with us</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('privacy-policy') }}"
                                        class="text-white text-capitalize text-decoration-none fw-light form-placeholder">Privacy Policy</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('terms-conditions') }}"
                                        class="text-white text-capitalize text-decoration-none fw-light form-placeholder">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Top Brands -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 d-md-block d-none">
                            <h3 class="h6">Top Brands</h3>
                            <div class="row"  style='margin-top:-3px;'>
                                <div class="col col-6">
                                    <ul class="list-unstyled">
                                        @foreach (@$brandsForFooter->take(5) as $key => $brand)
                                            <li class="mt-1">
                                                <a href="{{ route('product-by.brand', $brand->slug) }}" class="text-white text-capitalize text-decoration-none fw-light form-placeholder">
                                                     
                                                    {{ ucfirst($brand->name) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col col-6">
                                    <ul class="list-unstyled">
                                        @foreach (@$brandsForFooter->skip(5)->take(5) as $brand)
                                            <li class="mt-1">
                                                <a href="{{ route('product-by.brand', $brand->slug) }}" class="text-white text-capitalize text-decoration-none fw-light form-placeholder">
                                                     
                                                    {{ ucfirst($brand->name) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 mb-3 mb-md-0 d-md-none d-block ">
                            <!-- <h3 class="h6">Top Brands</h3> -->
                            <div class="row">
                                <div class="col-12 d-md-block d-flex  justify-content-between px-0 mx-0">
                                    @foreach (@$brandsForFooter->take(4) as $key => $brand)
                                        <a href="{{ route('product-by.brand', $brand->slug) }}" class='py-2 px-2 d-flex flex-row justify-content-between align-items-center text-white text-decoration-none form-placeholder'>
                                            {{ ucfirst($brand->name) }} 
                                            <!-- <img class='ms-auto' src="{{ asset('assets/front/images/More.png') }}" alt="Softliee" height='13' width='13'> -->
                                        </a>
                                    @endforeach
                                </div>
{{--                                <div class="col col-4 d-md-block d-flex flex-column gap-2">
                                    @foreach (@$brandsForFooter->skip(4)->take(4) as $brand)
                                        <a href="{{ route('product-by.brand', $brand->slug) }}" class='py-2 px-2 d-flex flex-row justify-content-between align-items-center text-white text-decoration-none form-placeholder'>
                                            {{ ucfirst($brand->name) }} 
                                            <!-- <img src="{{ asset('assets/front/images/More.png') }}" alt="Softliee" height='13' width='13'> -->
                                        </a>
                                    @endforeach
                                </div>
                                <div class="col col-4 d-md-block d-flex flex-column gap-2">
                                    @foreach (@$brandsForFooter->skip(8)->take(4) as $brand)
                                        <a href="{{ route('product-by.brand', $brand->slug) }}" class='py-2 px-2 d-flex flex-row justify-content-between align-items-center text-white text-decoration-none form-placeholder'>
                                            {{ ucfirst($brand->name) }} 
                                            <!-- <img src="{{ asset('assets/front/images/More.png') }}" alt="Softliee" height='13' width='13'> -->
                                        </a>
                                    @endforeach
                                </div>--}}
                            </div>
                        </div>

                        <!-- Main Menu -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 d-none d-md-block">
                            <h3 class="h6">Main Menu</h3>
                            <ul class="list-unstyled">
                                <li class="mt-1">
                                    <a href="{{ route('popular.mobiles') }}"
                                        class="text-white text-capitalize text-decoration-none form-placeholder fw-light"> Popular Mobiles</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('upcoming.mobiles') }}"
                                        class="text-white text-capitalize text-decoration-none form-placeholder fw-light"> Upcoming Mobiles</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('compare-page') }}"
                                        class="text-white text-capitalize text-decoration-none form-placeholder fw-light"> Compare Mobile</a>
                                </li>
                                <li class="mt-1">
                                    <a href="{{ route('phone-finder') }}" class="text-white text-capitalize text-decoration-none form-placeholder fw-light">Phone Finder</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Download App -->
                        <div class="col-12 col-md-3 d-none d-md-block">
                            <h3 class="h6">Download App</h3>
                            <a href="https://play.google.com/store/apps/details/?id=com.mobilestore.softliee&amp;hl"
                                target="_blank">
                                <img src="{{ asset('assets/front/images/playstore.png') }}" alt="Play Store" class="img-fluid my-md-1 my-3"
                                    style="max-width: 152px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg-black text-white py-3 border-top border-secondary">
            <div class="container">
                <div class="row align-items-start justify-content-start ps-md-0 pe-md-5 col-rev rel">
                    <div class="col-12 col-md-6 mb-2 mb-sm-0 form-placeholder">
                        <p class="mb-0 text-md-left text-center">{!! $siteSettings->copyright !!}
                        </p>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end mb-2 mb-md-0">
                        <a href="{{ $siteSettings->facebook }}" target="_blank" class="text-white mx-2 ico_size"><i
                                class="fa fa-facebook"></i></a>
                        <a href="{{ $siteSettings->youtube }}" target="_blank"
                            class="text-white mx-2 ico_size"><i class="fa fa-youtube"></i></a>
                        <a href="{{ $siteSettings->linkedin }}" target="_blank" class="text-white mx-2 ico_size"><i
                                class="fa fa-linkedin"></i></a>
                        <a href="{{ $siteSettings->pinterest }}" target="_blank" class="text-white mx-2 ico_size"><i
                                class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
</footer>
