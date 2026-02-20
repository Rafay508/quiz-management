@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')

<div class="container mt-md-3 mt-5 margin overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center mt-0 mt-md-0">
        <div class="col-md-12 col-lg-12">
            <div class="row d-none d-md-block">
                <div class="col-12">
                    @if ($siteSettings->home_banner && file_exists(uploadsDir('front') . $siteSettings->home_banner))
                        <img src="{!! asset(uploadsDir('front') . $siteSettings->home_banner) !!}" alt="Home banner"
                        class="d-block w-100 lazy">
                    @else
                        <img src="{{ asset('assets/front/images/Slide1.png') }}" alt="Home banner" class="d-block w-100 lazy">
                    @endif
                </div>
            </div>
            <div class="row py-md-4 g-1">
                <div class="col col-12 col-md-6 ">
                    <h5 class='fw-bold px-2 py-1 border-start border-danger border-4 heading mb-3'>Lets Find a Mobile
                        Phone
                    </h5>
                    <form action="{{ route('filter-mobile') }}" method="GET" class="container p-2 ps-md-1 pe-md-5 px-3 d-flex flex-column gap-md-3 gap-1 mt-md-4 mt-2">

                        <div class="slider-container mt-2" style="position: relative; width: 100%; height: 50px;">
                            <div class="slider-track accent-color">
                            </div>
                            <input class='range range-1' type="range" min="0" max="1000000" value="0" id="slider-1">
                            <input class='range range-2' type="range" min="0" max="1000000" value="1000000"
                                id="slider-2">
                            <div class="values d-none">Value</div>
                        </div>

                        <div class="d-flex flex-row justify-content-center gap-0 gap-md-4 align-items-center ">
                            <div class="d-flex flex-row gap-3 align-items-center">
                                <p class='fw-bold mt-2 d-none d-md-block'>RS.</p>
                                <input type="text"
                                    class='form-control form-control-sm w-md-75 fw-semibold p-md-2 p-2 py-2 px-md-4 px-2 rounded text-black-50 fs-6 range-input'
                                    min="0" max="1000000" value="0" id="range1" name="min_price">
                            </div>
                            <p class='text-custom fw-bold fs-5 m-2 mx-3'>TO</p>
                            <div class="d-flex flex-row gap-3 align-items-center justify-content-end">
                                <p class='fw-bold mt-2 d-none d-md-block'>RS.</p>
                                <input type="text"
                                    class='form-control form-control-sm w-md-75 fw-semibold p-md-2 p-2 py-2 px-md-4 px-2 rounded text-black-50 fs-6 range-input'
                                    min="0" max="1000000" value="1000000" id="range2" name="max_price">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom rounded-1 py-2 fw-bold focus-shadow text-center d-flex align-items-center justify-content-center btn-find mt-4 mt-md-0"
                            onclick="this.classList.toggle('nav-shadow')">Find Mobile
                        </button>
                        <div class="d-flex flex-column gap-2 mt-3 mt-md-2">
                            <h6 class='fw-bold text-black-50 form-placeholder'>Browse By Budget</h6>
                            <div class="row flex-row mt-2">
                                <div class="budget-slider-wrapper d-md-none d-block">
                                    <div class="budget-slider">
                                        <a href="{{ route('filter-mobile', ['budget' => 10000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            10K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 15000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            15K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 25000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            25K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 35000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            35K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 45000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            45K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 65000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            65K
                                        </a>
                                        <a href="{{ route('filter-mobile', ['budget' => 85000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            85K
                                        </a>
                                        <a href="{{ route('filter-mobile') }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-3 px-md-2 px-xl-3">
                                            Above
                                        </a>
                                    </div>
                                </div>

                                <div class="col d-flex flex-row g-0 justify-content-center gap-1 gap-lg-2 gap-xl-2 d-md-block d-none">
                                    <a href="{{ route('filter-mobile', ['budget' => 10000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        10K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 15000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        15K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 25000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        25K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 35000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        35K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 45000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        45K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 65000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        65K
                                    </a>
                                    <a href="{{ route('filter-mobile', ['budget' => 85000]) }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        85K
                                    </a>
                                    <a href="{{ route('filter-mobile') }}" class="btn btn-outline-light btn-price fw-semibold card-shadow px-2 px-xl-3">
                                        Above
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Brands -->
                <div class="col col-12 col-md-6 d-flex flex-column gap-3 mt-5 mt-md-0 d-none d-md-block">
                    <h5 class='fw-bold px-2 py-1 border-start border-danger border-4 heading'>By Brand</h5>
                    <div class="row g-0 mt-4">
                        <div class="col col-4 d-flex flex-column gap-custom">
                            @foreach (@$brands->take(5) as $key => $brand)
                                <p class='py-0 px-2 border-start border-dark-50 border-1 d-flex flex-row justify-content-between align-items-center brand-768'>
                                    <a href="{{ route('product-by.brand', $brand->slug) }}" class="text-decoration-none fw-bold text-hover ">{{ ucfirst($brand->name) }} </a>
                                    <img src="{{ asset('assets/front/images/Navigation Left Icon.svg') }}" alt="Softliee" height='30' width='40' class=" lazy">
                                </p>
                            @endforeach
                        </div>
                        <div class="col col-4 d-flex flex-column gap-custom">
                            @foreach (@$brands->skip(5)->take(5) as $brand)
                                <p class='py-0 px-2 border-start border-dark-50 border-1 d-flex flex-row justify-content-between align-items-center brand-768'>
                                    <a href="{{ route('product-by.brand', $brand->slug) }}" class='text-decoration-none fw-bold text-hover '>{{ ucfirst($brand->name) }} </a>
                                    <img src="{{ asset('assets/front/images/Navigation Left Icon.svg') }}" alt="Softliee" height='30' width='40' class=" lazy">
                                </p>
                            @endforeach
                        </div>
                        <div class="col col-4 d-flex flex-column gap-custom">
                            @foreach (@$brands->skip(10)->take(4) as $brand)
                                <p class='py-0 px-2 border-start border-dark-50 border-1 d-flex flex-row justify-content-between align-items-center brand-768'>
                                    <a href="{{ route('product-by.brand', $brand->slug) }}" class='text-decoration-none fw-bold text-hover '>{{ ucfirst($brand->name) }} </a>
                                    <img src="{{ asset('assets/front/images/Navigation Left Icon.svg') }}" alt="Softliee" height='30' width='40' class=" lazy">
                                </p>
                            @endforeach
                            <p
                                class='py-0 px-2 border-start border-dark-50 border-1 d-flex flex-row justify-content-between align-items-center fw-bold brand-768'>
                                <a href="#" class='text-decoration-none fw-bold text-dark'>More </a><img
                                    src="{{ asset('assets/front/images/Navigation Left Icon.svg') }}" alt="Softliee"
                                    height='30' width='40' class=" lazy">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ads -->
{{-- <section class="ads-section margin-bottom-50px">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <p class="ads-text">ADS</p>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2933454440337038" crossorigin="anonymous"></script>
                    <!-- 720 x90 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-2933454440337038"
                         data-ad-slot="6702463586"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
            </div>
        </div>
    </div>
</section> --}}

<!-- Recommended for you -->
@if (@$trending_products && count($trending_products) > 0)
<div class="container pt-md-3 py-1 pb-0 overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row py-4 px-0">
                <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 heading'>
                    Recommended For You</h5>
                <div class="container py-4">
                    <div class="custom-slider-container">
                        <div class="custom-slider-wrapper carousel-wrapper" id="sliderWrapper1">
                            @foreach ($trending_products as $product)
                                <div class="carousel-slide custom-slider-item py-1">
                                    <div class="card rounded-0 pt-2 px-md-0 px-0 px-lg-0 px-xl-0 border-secondary border-opacity-25 card-shadow">
                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                                <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 prod-img  lazy"
                                                     src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->alt_image }}" width='4vw' >
                                            </a>
                                        @else
                                            <img class="card-img-top px-md-5 px-3 pt-2  lazy"
                                                 src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                 alt="placeholder image">
                                        @endif

                                        <div class="card-body text-center px-0">
                                            @if (@$product->galleries && count($product->galleries) > 0)
                                                <a href="{{ route('product.pictures', $product->slug) }}" 
                                                   class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline mb-2">
                                                   View Photos ({{ count($product->galleries) }})
                                                </a>
                                            @endif

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <h6 class="card-text fw-bolder text-black product-font mt-1 mb-1">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                            </a>

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <p class="card-text fw-semibold product-price mt-0 mb-2" style='color: #737373;'>
                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                </p>
                                            </a>

                                            <a href="{{ route('compare-page', ['from' => $product->slug]) }}" class="btn btn-custom rounded-1 font-sm px-md-3 px-3 fw-medium mt-0">
                                                Compare <i class="ms-1 fa-solid fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="carousel-scrollbar">
                                <div class="scrollbar-thumb"></div>
                            </div>

                        </div>
                        <!-- Controls -->
                        <button
                            class="custom-slider-control custom-slider-control-prev text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="prev1">
                            <p style='position:relative;top: -11px;'>&lt;</p>
                        </button>
                        <button
                            class="custom-slider-control custom-slider-control-next text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="next1">
                            <p style='position:relative;top: -11px;'>&gt;</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Popular for you -->
@if (@$popular_products && count($popular_products) > 0)
<div class="container pt-md-0 py-1 pb-0 overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row py-4 px-0">
                <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 heading'>Populer
                    Mobiles For You</h5>
                <div class="container py-4">
                    <div class="custom-slider-container">
                        <div class="custom-slider-wrapper carousel-wrapper" id="sliderWrapper2">
                            @foreach ($popular_products as $product)
                                <div class="carousel-slide custom-slider-item py-1">
                                    <div class="card rounded-0 pt-2 px-md-0 px-0 px-lg-0 px-xl-0 border-secondary border-opacity-25 card-shadow">
                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                                <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 prod-img  lazy"
                                                     src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->alt_image }}" width='4vw'>
                                            </a>
                                        @else
                                            <img class="card-img-top px-md-5 px-3 pt-2  lazy"
                                                 src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                 alt="placeholder image">
                                        @endif

                                        <div class="card-body text-center px-0">
                                            @if (@$product->galleries && count($product->galleries) > 0)
                                                <a href="{{ route('product.pictures', $product->slug) }}" 
                                                   class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline mb-2">
                                                   View Photos ({{ count($product->galleries) }})
                                                </a>
                                            @endif

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <h6 class="card-text fw-semibold text-black product-font  mt-1 mb-1">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                            </a>

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <p class="card-text fw-bold product-price mt-0 mb-2" style='color: #737373;'>
                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                </p>
                                            </a>

                                            <a href="{{ route('compare-page', ['from' => $product->slug]) }}" class="btn btn-custom rounded-1 font-sm px-md-3 px-3 fw-medium mt-0">
                                                Compare <i class="ms-1 fa-solid fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="carousel-scrollbar">
                                <div class="scrollbar-thumb"></div>
                            </div>

                        </div>
                        <!-- Controls -->
                        <button
                            class="custom-slider-control custom-slider-control-prev text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="prev2">
                            <p style='position:relative;top: -11px;'>&lt;</p>
                        </button>
                        <button
                            class="custom-slider-control custom-slider-control-next text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="next2">
                            <p style='position:relative;top: -11px;'>&gt;</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Upcomming for you -->
@if (@$upcoming_products && count($upcoming_products) > 0)
<div class="container py-md-0 py-1 pb-0 overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row py-4 px-0">
                <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 heading'>Upcoming
                    Mobiles For You</h5>
                <div class="container py-4">
                    <div class="custom-slider-container">
                        <div class="custom-slider-wrapper carousel-wrapper" id="sliderWrapper3">
                            {{-- @foreach ($upcoming_products as $product)
                                <div class="carousel-slide custom-slider-item py-1">
                                    <div class="card rounded-0 pt-2 px-md-0 px-0 px-lg-0 px-xl-0 border-secondary border-opacity-25 card-shadow">
                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                                <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 prod-img  lazy"
                                                     src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->alt_image }}" width='4vw'>
                                            </a>
                                        @else
                                            <img class="card-img-top px-md-5 px-3 pt-2  lazy"
                                                 src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                 alt="placeholder image">
                                        @endif

                                        <div class="card-body text-center px-0 ">
                                            @if (@$product->galleries && count($product->galleries) > 0)
                                                <a href="{{ route('product.pictures', $product->slug) }}" 
                                                   class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline mb-2">
                                                   View Photos ({{ count($product->galleries) }})
                                                </a>
                                            @endif

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <h6 class="card-text fw-bolder text-black product-font  mt-1 mb-1">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                            </a>

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <p class="card-text fw-semibold product-price mt-0 mb-2" style='color: #737373;'>
                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                </p>
                                            </a>

                                            <a href="{{ route('compare-page', ['from' => $product->slug]) }}" class="btn btn-custom rounded-1 font-sm px-md-3 px-3 fw-medium mt-0">
                                                Compare <i class="ms-1 fa-solid fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                            @foreach ($upcoming_products as $product)
                                <div class="carousel-slide custom-slider-item py-1">
                                    <div class="card rounded-0 pt-2 px-md-0 px-0 px-lg-0 px-xl-0 border-secondary border-opacity-25 card-shadow position-relative">
                                        
                                        {{-- Badge: Updated x time ago --}}
                                        @if ($product->updated_at)
                                            <div class="position-absolute top-0 start-0 bg-dark text-white small px-2 py-1 mt-4 rounded" style="z-index: 10;">
                                                Updated {{ $product->updated_at->diffForHumans(now(), true) . ' ago' }}
                                            </div>
                                        @endif

                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                                <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 prod-img  lazy"
                                                     src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->alt_image }}" width='4vw'>
                                            </a>
                                        @else
                                            <img class="card-img-top px-md-5 px-3 pt-2  lazy"
                                                 src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                 alt="placeholder image">
                                        @endif

                                        <div class="card-body text-center px-0 ">
                                            @if (@$product->galleries && count($product->galleries) > 0)
                                                <a href="{{ route('product.pictures', $product->slug) }}" 
                                                   class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline mb-2">
                                                   View Photos ({{ count($product->galleries) }})
                                                </a>
                                            @endif

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <h6 class="card-text fw-bolder text-black product-font  mt-1 mb-1">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                            </a>

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                                <p class="card-text fw-semibold product-price mt-0 mb-2" style='color: #737373;'>
                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                </p>
                                            </a>

                                            <a href="{{ route('compare-page', ['from' => $product->slug]) }}" class="btn btn-custom rounded-1 font-sm px-md-3 px-3 fw-medium mt-0">
                                                Compare <i class="ms-1 fa-solid fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="carousel-scrollbar">
                                <div class="scrollbar-thumb"></div>
                            </div>

                        </div>
                        <!-- Controls -->
                        <button
                            class="custom-slider-control custom-slider-control-prev text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="prev3">
                            <p style='position:relative;top: -11px;'>&lt;</p>
                        </button>
                        <button
                            class="custom-slider-control custom-slider-control-next text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="next3">
                            <p style='position:relative;top: -11px;'>&gt;</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .web-card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .web-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .web-card-body {
        padding: 12px;
        background: white;
        color: #181818;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .web-card-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .web-card-text {
        flex: 1;
    }

    .web-card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .web-card-date {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.5);
    }

    .web-share-icon {
        font-size: 1rem;
        color: rgba(0, 0, 0, 0.5);
        cursor: pointer;
        margin-left: 12px;
    }

    .web-share-icon i {
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 50%;
        padding: 8px;
    }

    @media screen and (max-width: 768px) {
        .web-card img {
            height: 150px;
        }

        .web-card-title {
            font-size: 0.9rem;
        }

        .web-card-date {
            font-size: 10px;
        }

        .web-share-icon {
            font-size: 0.8rem;
        }

        .web-share-icon i {
            padding: 6px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />

@if (@$web_story_categories && count($web_story_categories) > 0)
<div class="container py-md-0 py-1 pb-0 overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row py-4 px-0">
                <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 heading'>Web Stories</h5>
                <div class="container py-4">
                    <div class="custom-slider-container">
                        <div class="custom-slider-wrapper carousel-wrapper" id="sliderWrapper4">
                            @foreach ($web_story_categories as $category)
                                <div class="carousel-slide custom-slider-item py-1">
                                    {{-- @foreach ($web_story_categories as $category) --}}
                                    
                                        <a href="{{ route('web-story.detail', $category->slug) }}" class="text-decoration-none">
                                            <div class="web-card mb-0 pb-0">
                                                <img src="{{ asset('uploads/web-stories/' . $category->image) }}"
                                                    alt="{{ $category->title }}" class=" lazy">
                                                <div class="web-card-body">
                                                    <div class="web-card-content">
                                                        <div class="web-card-text">
                                                            <h6 class="web-card-title fw-bolder">{{ ucfirst($category->title) }}</h6>
                                                            <p class="web-card-date fw-bold mb-0">
                                                                {{ date('M d, Y', strtotime($category->created_at)) }}
                                                            </p>
                                                        </div>
                                                        <span class="web-share-icon"
                                                            onclick="shareStory(event, '{{ route('web-story.detail', $category->slug) }}')">
                                                            <i class="fa-solid fa-share-nodes"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    
                                {{-- @endforeach --}}
                                </div>
                            @endforeach
                            <script>
                                function shareStory(event, url) {
                                    event.preventDefault();
                                    if (navigator.share) {
                                        navigator.share({
                                            title: 'Web Story',
                                            url: url
                                        }).catch(console.error);
                                    } else {
                                        alert('Sharing not supported on this browser.');
                                    }
                                }
                            </script>
                        
                            <div class="carousel-scrollbar">
                                <div class="scrollbar-thumb"></div>
                            </div>

                        </div>
                        <!-- Controls -->
                        <button
                            class="custom-slider-control custom-slider-control-prev text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="prev4">
                            <p style='position:relative;top: -11px;'>&lt;</p>
                        </button>
                        <button
                            class="custom-slider-control custom-slider-control-next text-black bg-light border-1 border-dark fs-1 pb-1 d-none d-md-block"
                            id="next4">
                            <p style='position:relative;top: -11px;'>&gt;</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Tech news -->
@if (@$blogs && count($blogs) > 0)
<div class="container py-md-0 py-0 overflow-hidden">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row pb-4 pt-3 px-2">
                <h5 class='fw-bold px-2 pt-1 pb-2 border-start border-danger border-4 heading'>Tech News
                </h5>
            </div>
            <div class="row pb-3 g-3 pt-4">
                @foreach ($blogs as $blog)
                <div class="col-12 col-md-6 mt-0">
                    <div class="card mb-3 rounded-0 py-md-3 pt-1 px-md-4 px-lg-2 px-4 card-shadow tech-h">
                        <a href="{{ route('blog-details', $blog->slug) }}" class="row g-0 align-items-center text-decoration-none text-dark">
                            <div class="col-5 d-flex flex-column justify-content-center align-items-center">
                                <div class="w-100 h-100 d-flex justify-content-center">
                                    @if ($blog->image && file_exists(public_path('uploads/blogs/' .
                                    $blog->image)))
                                    <img class="img-fluid rounded-0 object-fit-contain tech-img" height='100'
                                        width='100' src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->alt_image }}">
                                    @else
                                    <img class="img-fluid rounded-0 object-fit-cover  tech-img"
                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                        alt="placeholder image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="card-body ps-xl-0 pe-lg-5">
                                    <h6 class="card-title fw-bold ">
                                        {{ Str::limit($blog->name, 40, '...') }}
                                    </h6>
                                    <!-- <p class="card-text mt-0 tech-font">
                                        <small class="text-danger fw-bold text-decoration-underline"
                                            style="position:relative;top: -4px;">
                                            <a href="javascript:void(0)">Read More</a>
                                        </small>
                                    </p> -->
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endif

<!-- Mobile comparisons -->
<div class="container pt-1 pb-md-5 mb-md-5 mb-0 pb-4 overflow-hidden">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="row py-4 px-2">
                <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 heading'>
                    Mobile Comparisons For You</h5>
            </div>
            <div class="row g-3 mt-2">
                @for ($i = 0; $i < count($comparing_products); $i += 2)
                <a href="{{ 
                        route('compare-page', [
                            'from' => $comparing_products[$i]->slug ?? '',
                            'to' => $comparing_products[$i+1]->slug ?? ''
                        ]) 
                    }}" class="col-12 col-md-6 mt-0 text-decoration-none text-dark">
                    <div class="card card-shadow mb-3 rounded-0">
                        <div class="card-body d-flex align-items-center px-0">
                            <div class="d-flex align-items-center ps-2" style='width:45%'>
                                @if ($comparing_products[$i]->image && file_exists(public_path('uploads/products/' . $comparing_products[$i]->image)))
                                    <img class="img-fluid img-compare lazy" src="{{ asset('uploads/products/' . $comparing_products[$i]->image) }}" alt="{{ $comparing_products[$i]->alt_image }}">
                                @else
                                    <img class="img-fluid img-compare lazy" src="https://via.placeholder.com/300x100.png?text=No+Image" alt="placeholder image">
                                @endif
                                <div class="ms-2 d-md-block d-flex justify-content-center align-items-center">
                                    <h6 class="fw-bold mb-2 form-placeholder    w-md-100 text-dark">
                                        {{ ucfirst($comparing_products[$i]->name) }}
                                    </h6>
                                    <p class="mb-0 fw-bold text-black-50 font-comp d-none d-md-block">
                                        {{ env('CURRENCY', 'PKR') . ' ' . number_format($comparing_products[$i]->original_price) }}
                                    </p>
                                </div>
                            </div>
                            <div class="mx-0 mx-md-2 ms-3 me-3" style='width:10%'>
                                <span class=" btn-custom d-flex justify-content-center align-items-center rounded-circle vs">VS</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-start ps-2 ps-xl-4" style='width:45%'>
                                @if ($comparing_products[$i+1]->image && file_exists(public_path('uploads/products/' . $comparing_products[$i+1]->image)))
                                    <img class="img-fluid img-compare" src="{{ asset('uploads/products/' . $comparing_products[$i+1]->image) }}" alt="{{ $comparing_products[$i+1]->alt_image }}">
                                @else
                                    <img class="img-fluid img-compare" src="https://via.placeholder.com/300x100.png?text=No+Image" alt="placeholder image">
                                @endif
                                <div class="ms-2 d-md-block d-flex justify-content-center align-items-center">
                                    <h6 class="fw-bold mb-2 form-placeholder w-md-100">
                                        {{ ucfirst($comparing_products[$i+1]->name) }}
                                    </h6>
                                    <p class="mb-0 fw-bold text-black-50 form-placeholder  d-none d-md-block">
                                        {{ env('CURRENCY', 'PKR') . ' ' . number_format($comparing_products[$i+1]->original_price) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-js')
<!-- products slider -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.body.classList.add("loading");

        const sliders = [{
                wrapper: document.querySelector("#sliderWrapper1"),
                prevBtn: document.querySelector("#prev1"),
                nextBtn: document.querySelector("#next1"),
                scrollbar: document.querySelector("#sliderWrapper1 .carousel-scrollbar"),
                thumb: document.querySelector("#sliderWrapper1 .scrollbar-thumb"),
            },
            {
                wrapper: document.querySelector("#sliderWrapper2"),
                prevBtn: document.querySelector("#prev2"),
                nextBtn: document.querySelector("#next2"),
                scrollbar: document.querySelector("#sliderWrapper2 .carousel-scrollbar"),
                thumb: document.querySelector("#sliderWrapper2 .scrollbar-thumb"),
            },
            {
                wrapper: document.querySelector("#sliderWrapper3"),
                prevBtn: document.querySelector("#prev3"),
                nextBtn: document.querySelector("#next3"),
                scrollbar: document.querySelector("#sliderWrapper3 .carousel-scrollbar"),
                thumb: document.querySelector("#sliderWrapper3 .scrollbar-thumb"),
            },
            {
                wrapper: document.querySelector("#sliderWrapper4"),
                prevBtn: document.querySelector("#prev4"),
                nextBtn: document.querySelector("#next4"),
                scrollbar: document.querySelector("#sliderWrapper4 .carousel-scrollbar"),
                thumb: document.querySelector("#sliderWrapper4 .scrollbar-thumb"),
            }
        ];

        sliders.forEach((slider) => {
            const {
                wrapper,
                prevBtn,
                nextBtn,
                scrollbar,
                thumb
            } = slider;
            const slides = wrapper.querySelectorAll(".carousel-slide");
            const slideWidth = 144 + 8; // Slide width including margin
            let maxScroll = wrapper.scrollWidth - wrapper.clientWidth;

            const resizeScrollbarThumb = () => {
                thumb.style.width =
                    `${(wrapper.clientWidth / wrapper.scrollWidth) * 100}%`;
            };

            const positionScrollbarThumb = () => {
                const scrollPositionX = wrapper.scrollLeft;
                const thumbPositionX = (scrollPositionX / maxScroll) * (scrollbar
                    .clientWidth - thumb.offsetWidth);
                thumb.style.left = `${thumbPositionX}px`;
            };

            const hideShowSliderNavButtons = () => {
                document.body.classList.toggle(
                    `slider-start-${wrapper.id}`,
                    wrapper.scrollLeft <= 0
                );
                document.body.classList.toggle(
                    `slider-end-${wrapper.id}`,
                    wrapper.scrollLeft + wrapper.offsetWidth >= wrapper.scrollWidth
                );
            };

            wrapper.addEventListener("scroll", () => {
                hideShowSliderNavButtons();
                positionScrollbarThumb();
            });

            hideShowSliderNavButtons();
            resizeScrollbarThumb();
            positionScrollbarThumb();

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener("click", (event) => {
                    event.preventDefault();
                    wrapper.scrollTo({
                        left: wrapper.scrollLeft - slideWidth,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener("click", (event) => {
                    event.preventDefault();
                    wrapper.scrollTo({
                        left: wrapper.scrollLeft + slideWidth,
                        behavior: 'smooth'
                    });
                });
            }

            if (thumb) {
                let startX, thumbPosition, isMouseDown = false;

                thumb.addEventListener("mousedown", (event) => {
                    event.preventDefault();
                    isMouseDown = true;
                    thumb.classList.add("dragging");
                    wrapper.classList.add("dragging");
                    startX = event.clientX;
                    thumbPosition = event.target.offsetLeft;
                });

                document.addEventListener("mousemove", (event) => {
                    if (!isMouseDown) return;
                    event.preventDefault();
                    const deltaX = event.clientX - startX;
                    const newThumbPosition = thumbPosition + deltaX;
                    const maxThumbPosition = scrollbar.getBoundingClientRect()
                        .width - thumb.offsetWidth;
                    const thumbPositionX = Math.max(0, Math.min(maxThumbPosition,
                        newThumbPosition));
                    const sliderScrollLeft = (thumbPositionX / maxThumbPosition) *
                        maxScroll;
                    thumb.style.left = `${thumbPositionX}px`;
                    wrapper.scrollLeft = sliderScrollLeft;
                });

                document.addEventListener("mouseup", (event) => {
                    event.preventDefault();
                    isMouseDown = false;
                    thumb.classList.remove("dragging");
                    wrapper.classList.remove("dragging");
                });
            }

            window.onresize = () => {
                maxScroll = wrapper.scrollWidth - wrapper.clientWidth;
                resizeScrollbarThumb();
                positionScrollbarThumb();
            };
        });

        window.onload = function() {
            if (document.body.classList.contains("loading")) {
                document.body.classList.add("loaded");
            } else {
                setTimeout(() => {
                    document.body.classList.add("loaded");
                }, 1000);
            }
        };
    });
</script>

<!-- price range slider -->
<script>
    window.onload = function() {
        updateSliderValues();
    };

    // References to slider elements
    let sliderOne = document.getElementById("slider-1");
    let sliderTwo = document.getElementById("slider-2");
    let displayValOne = document.getElementById("range1");
    let displayValTwo = document.getElementById("range2");
    let sliderTrack = document.querySelector(".slider-track");
    let minGap = 00;
    let sliderMaxValue = 1000000; // Set max value to 1,000,000

    function updateSliderValues() {
        // Ensure sliders respect minGap constraint
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValOne.value = sliderOne.value;
        displayValTwo.value = sliderTwo.value;
        fillColor();
    }

    function fillColor() {
        let percent1 = (sliderOne.value / sliderMaxValue) * 100;
        let percent2 = (sliderTwo.value / sliderMaxValue) * 100;
        sliderTrack.style.background =
            `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }

    // Handle slider movements
    sliderOne.addEventListener('input', function() {
        if (parseInt(sliderOne.value) >= parseInt(sliderTwo.value) - minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.value = sliderOne.value;
        fillColor();
    });

    sliderTwo.addEventListener('input', function() {
        if (parseInt(sliderTwo.value) <= parseInt(sliderOne.value) + minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.value = sliderTwo.value;
        fillColor();
    });

    // Update slider values on input change
    displayValOne.addEventListener('input', function() {
        let value = parseInt(displayValOne.value) || 0; // Default to 0 if NaN
        if (value < 0) {
            value = 0;
        } else if (value > sliderMaxValue) {
            value = sliderMaxValue;
        }
        if (value >= parseInt(displayValTwo.value) - minGap) {
            value = parseInt(displayValTwo.value) - minGap;
        }
        displayValOne.value = value;
        sliderOne.value = value;
        fillColor();
    });

    displayValTwo.addEventListener('input', function() {
        let value = parseInt(displayValTwo.value) || 0; // Default to 0 if NaN
        if (value < 0) {
            value = 0;
        } else if (value > sliderMaxValue) {
            value = sliderMaxValue;
        }
        if (value <= parseInt(displayValOne.value) + minGap) {
            value = parseInt(displayValOne.value) + minGap;
        }
        displayValTwo.value = value;
        sliderTwo.value = value;
        fillColor();
    });

    // Ensure the z-index is managed for dragging
    sliderOne.addEventListener('mousedown', () => {
        sliderOne.style.zIndex = 2;
        sliderTwo.style.zIndex = 1;
    });
    sliderTwo.addEventListener('mousedown', () => {
        sliderTwo.style.zIndex = 2;
        sliderOne.style.zIndex = 1;
    });

    // Reset z-index on mouseup
    document.addEventListener('mouseup', () => {
        sliderOne.style.zIndex = 1;
        sliderTwo.style.zIndex = 1;
    });
</script>
@endsection
