@extends('front.layouts.app')

<!-- Meta -->
@section('title', $product->meta_title)

@section('css')
    <style type="text/css">
        .select2-selection__rendered {
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Default height for larger screens */
        .height {
            height: 400px;
        }

        /* Adjust height for screens smaller than 768px */
        @media screen and (max-width: 768px) {
            .height {
                height: 250px; /* Adjust this height as per your needs */
            }
        }

        .compare-by-mobile-close-button {
            position: absolute;
            top: -20px !important;
            right: 35px !important;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-3 margin resp overflow-hidden" style='width:100vw;'>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12   ms-0 me-0 pe-0">
                <div class="row gap-2 ms-0  me-0 pe-0">
                    <div class="col-12 d-flex align-items-center gap-1 d-none d-md-flex mb-0 pb-0">
                        <p class="form-placeholder text-black-50 fw-semibold">
                            <a class="text-decoration-none text-black-50 fw-semibold"
                                href="{{route('home')}}">
                                 Home
                                <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                            </a>
                        </p>
                        <p class="form-placeholder text-black-50 fw-semibold">
                            <a class="text-decoration-none text-black-50 fw-semibold"
                                href="{{ route('product-by.brand', @$product->brand->slug) }}">
                                {!! ucfirst(@$product->brand->name ?? '-') !!}
                                <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                            </a>
                        </p>
                        <p class="form-placeholder text-black-50 fw-semibold">{!! ucfirst($product->name ?? '-') !!}
                            <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                        </p>
                        @if (@$product->brand->reference_link)
                        <div class="d-flex ms-auto pb-3 align-items-center">
                            @if (@$product->brand->image && file_exists(public_path('uploads/brands/' . $product->brand->image)))
                            <a href="{{ asset('uploads/brands/' . $product->brand->image) }}" data-lightbox="product-gallery" data-title="{{ @$product->brand->alt_image ?? 'Pictures' }}">
                            <img class='pb-2' style=" width: 50px;height: 50px;border-radius: 50%;object-fit: contain;"
                                src="{{ asset('uploads/brands/' . $product->brand->image) }}"
                                alt="{{ @$product->brand->alt_image }}">
                            </a>
                        @else
                            <img class='img-fluid'
                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                alt="placeholder image">
                        @endif
                                <a href="{{ @$product->brand->reference_link }}" class='text-black-50 ms-2 fw-semibold form-placeholder'
                                    style='position:relative;top:-5px;'>
                                    {{ @$product->brand->name }} Official Website
                                </a>
    
                        </div>

                        @endif
                    </div>
                    <div class="container-fliud">
                        @include('front.layouts.partials.head-ad')
                    </div>
                    <div class="col-12 mb-md-3 mt-md-2">
                        <div class="col-12 mt-0 bg-custom">
                            <div class="p-3 px-1">
                                <div class="d-md-flex justify-content-between pb-1 section-bottom align-items-center px-md-3 d-none">
                                    <h4 class='fw-semibold'>{!! ucfirst($product->name ?? '-') !!}</h4>
                                    {{-- <a target="_blank" href="{{ route('product.story', $product->slug) }}">Click here to view story</a> --}}
                                    <img src="{{ asset('assets/front/images/share-icon.svg') }}" width='25'
                                        class='d-none d-md-block' id="share-icon" style="cursor: pointer;">
                                </div>
                                <div class="row p-1 pt-3 d-none d-md-flex">
                                    <div class="col col-3 pb-2 d-flex justify-content-center align-items-end mx-0 px-0">
                                        <div class="img-prod-container d-flex justify-content-center align-items-center">
                                            @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <a href="{{ asset('uploads/products/' . $product->image) }}" data-lightbox="product-image" data-title="{{ $product->alt_image }}">
                                                <img class='img-prod-detail' style='object-fit:contain;width:100%'
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="{{ $product->alt_image }}">
                                            </a>
                                            @else
                                                <img class='img-fluid'
                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                    alt="placeholder image">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-9 d-flex flex-column justify-content-between">
                                        <div class="row mt-3">
                                            <div class="col d-flex flex-column gap-1">
                                                <div class="d-flex flex-row align-items-center gap-2"><img
                                                        src="{{ asset('assets/front/images/battery-timing.svg') }}"
                                                        alt="BatteryTiming" width='22'>
                                                    <div class='fw-semibold form-placeholder'>
                                                        {{ ucfirst($product->battery_drain_time ?? '-') }}</div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center gap-2"><img
                                                        src="{{ asset('assets/front/images/Core.svg') }}"
                                                        alt="BatteryTiming" width='22'>
                                                    <div class='fw-semibold form-placeholder'>
                                                        {{ ucfirst($product->processor ?? '-') }}</div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center gap-2"><img
                                                        src="{{ asset('assets/front/images/rgb.svg') }}"
                                                        alt="BatteryTiming" width='22'>
                                                    <div class='fw-semibold form-placeholder'>
                                                        {{ ucfirst($product->colors ?? '-') }}</div>
                                                </div>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <div class="d-flex flex-column me-3">
                                                    @if ($product->availability_status == "Coming Soon")
                                                        <span class="text-light bg-danger badge">Expected</span>
                                                    @endif
                                                    <div class="h3 fw-semibold" style='color:red;'>
                                                        {{ env('CURRENCY', 'RS') . ' ' . number_format($product->original_price ?? '-') }}
                                                    </div>
                                                    <div class=" fw-semibold">
                                                        {{ ucfirst($product->availability_status ?? '-') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-content-end">
                                            <div
                                                class="col-3 border-end border-2 d-flex flex-column d-flex justify-content-start pt-2">
                                                <img src="{{ asset('assets/front/images/video-display.png') }}"
                                                    alt="Camera" width='30' height='30' class='rounded-1'>
                                                <div class="h2 fw-semibold mt-2 d-flex align-items-end size-768">
                                                    {{ ucfirst($product->display_size ?? '-') }}<div
                                                        class="form-placeholder fw-semibold">Inches</div>
                                                </div>
                                                <p class='text-dark fw-normal form-placeholder mt-auto fw-semibold'>
                                                    Display
                                                </p>
                                            </div>
                                            <div
                                                class="col-3 border-end border-2 d-flex flex-column d-flex justify-content-start pt-2">
                                                <img src="{{ asset('assets/front/images/camera.svg') }}" alt="Camera"
                                                    width='30' class='rounded-1'>
                                                <div class="h2 fw-semibold mt-2 d-flex align-items-end size-768">
                                                    {{ $product->main_camera . '/' . $product->front_camera }}
                                                    <div class="form-placeholder fw-semibold">MP</div>
                                                </div>
                                                <p class='text-dark fw-normal form-placeholder  mt-auto fw-semibold'>
                                                    Camera
                                                </p>
                                            </div>
                                            <div
                                                class="col-3 border-end border-2 d-flex flex-column d-flex justify-content-start pt-2">
                                                <img src="{{ asset('assets/front/images/ramrom.png') }}" alt="Screen Size"
                                                    width='30' class='rounded-1'>
                                                <div class="h2 fw-semibold mt-2 d-flex align-items-end size-768">
                                                    {{ $product->ram . '/' . $product->storage }}
                                                    <div class="form-placeholder fw-semibold">GB</div>
                                                </div>
                                                <p class='text-dark fw-normal form-placeholder  mt-auto fw-semibold'>
                                                    Ram/Storage
                                                </p>
                                            </div>
                                            <div class="col-3 d-flex flex-column d-flex justify-content-start pt-2">
                                                <img src="{{ asset('assets/front/images/battery.svg') }}"
                                                    alt="Screen Size" width='30' class='rounded-1'>
                                                <div class="h2 fw-semibold mt-2 d-flex align-items-end size-768">
                                                    {{ ucfirst($product->battery ?? '-') }}
                                                    <div class="form-placeholder fw-semibold">Mah</div>
                                                </div>
                                                <p class='text-dark fw-normal form-placeholder mt-auto fw-semibold'>
                                                    Battery
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-1 pt-0 d-md-none">
                                    <div class="col col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                                        <div class="w-100 px-0 mx-0">
                                            @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                <img style="max-width:90%;object-fit:contain" class='px-0 mx-0'
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="{{ $product->alt_image }}">
                                            @else
                                                <img class='img-fluid'
                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                    alt="placeholder image">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-6 d-flex flex-column gap-2">
                                        <div
                                            class="d-flex flex-row align-items-center gap-2 border-bottom border-opacity-75">
                                            <img src="{{ asset('assets/front/images/video-display.png') }}"
                                                alt="Display" width='26' height='26' class='rounded-1'>
                                            <div class="d-flex flex-column">
                                                <p class='font-sm mb-1'>Display</p>
                                                <h5 class='fw-bold mt-0'>
                                                    {{ ucfirst($product->display_size ?? '-') }}<span
                                                    class='form-placeholder fw-bold'> Inches</span></h5>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-row align-items-center gap-2 border-bottom border-opacity-75">
                                            <img src="{{ asset('assets/front/images/camera.svg') }}" alt="Camera"
                                            width='26' height='26' class='rounded-1'>
                                            <div class="d-flex flex-column">
                                                <p class='font-sm mb-1'>Camera</p>
                                                <h5 class='fw-bold mt-0'>
                                                    {{ $product->main_camera . '/' . $product->front_camera }}<span
                                                    class='form-placeholder fw-bold'> MP</span></h5>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-row align-items-center gap-2 border-bottom border-opacity-75">
                                            <img src="{{ asset('assets/front/images/battery.svg') }}" alt="Battery"
                                            width='26' height='26' class='rounded-1'>
                                            <div class="d-flex flex-column">
                                                <p class='font-sm mb-1'>Battery</p>
                                                <h5 class='fw-bold mt-0'>{{ ucfirst($product->battery ?? '-') }}<span
                                                    class='form-placeholder fw-bold'> Mah</span></h5>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center gap-2">
                                            <img src="{{ asset('assets/front/images/ramrom.png') }}" alt="CPU"
                                            width='26' height='26' class='rounded-1'>
                                            <div class="d-flex flex-column">
                                                <p class='font-sm mb-1'>Ram/Storage</p>
                                                <h5 class='fw-bold mt-0'>
                                                    {{ $product->ram . '/' . $product->storage }}<span class='form-placeholder fw-bold'> GB</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-1 pt-3 d-md-none d-flex">
                                    <div class="col-6 d-flex flex-column gap-0 g-0">
                                        <div class="h6 fw-semibold">{!! ucfirst($product->name ?? '-') !!}</div> 
                                        <div class="h3 fw-semibold" style='color:red;'>
                                            {{ env('CURRENCY', 'RS') . ' ' . number_format($product->original_price ?? '-') }}
                                        </div>
                                        <div class="form-placeholder fw-semibold text-black-50">
                                            {{ ucfirst($product->availability_status ?? '-') }}
                                        </div>
                                        @if (@$product->brand->reference_link)
                                            <a href="{{ @$product->brand->reference_link }}"
                                                class='text-black-50 ms-3 pb-3 fw-bold d-none d-md-block'
                                                style='font-size:13px;position:relative;right:4.0vw; top:1.5vh;'>
                                                {{ @$product->brand->name }} Official Website
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex align-items-end">
                                        <a href="{{ route('compare-page', ['from' => $product->slug]) }}"
                                            class="btn btn-custom form-placeholder rounded-1 form-placeholder px-md-3 px-3 fw-semibold">
                                            Compare<i class="ms-1 fa-solid fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 bg-custom text-center border-top mt-3 mt-md-0">
                            <div class="row">

                                <div class="col p-2 border-end d-none d-md-block">
                                    <a href="#specs" class='text-decoration-none text-dark'>
                                        <div class="p-1 fw-semibold">
                                            Specifications
                                        </div>
                                    </a>
                                </div>
                                <div class="col p-2 border-end d-none d-md-block">
                                    <a href="#opinions" class='text-decoration-none text-dark'>
                                        <div class="p-1 fw-semibold">
                                            Opinions
                                        </div>
                                    </a>
                                </div>
                                <div class="col p-2 border-end d-none d-md-block">
                                    <a href="{{ route('compare-page', ['from' => $product->slug]) }}"
                                        class='text-decoration-none text-dark'>
                                        <div class="p-1 fw-semibold">
                                            Compare
                                        </div>
                                    </a>
                                </div>
                                <div class="col p-2 bg-mob-yellow">
                                    <a href="{{ route('product.pictures', $product->slug) }}"
                                        class='text-decoration-none text-dark'>
                                        <div class="p-1 fw-semibold">
                                            Picture
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (@$latest_mobiles && count($latest_mobiles) > 0)
                            <div class="col-12 d-md-none d-block">
                                <div class="container-fliud pt-4">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="row pt-4 px-1">
                                                <p class='fw-bold px-2 pt-1 border-start border-danger border-4'>
                                                    Check Out Upcoming Model <i
                                                        class='fa-solid fa-heart ms-2 text-danger'></i> <i
                                                        class='fa-solid fa-fire text-warning'></i>
                                                </p>
                                                <div class="container-fliud py-4">
                                                    <div class="row g-md-4 g-2">
                                                        @foreach ($latest_mobiles as $latestProduct)
                                                            <div class="col-12 d-flex flex-row gap-3">
                                                                <a href="{{ route('product.details', $latestProduct->slug) }}"
                                                                    class='text-decoration-none w-100 border-bottom'>
                                                                    <div class="card border-0 pb-2">
                                                                        <div class="row g-0">
                                                                            <div
                                                                                class="col-2 d-flex justify-content-center align-items-center">
                                                                                @if ($latestProduct->image && file_exists(public_path('uploads/products/' . $latestProduct->image)))
                                                                                    <img class="img-fluid"
                                                                                        src="{{ asset('uploads/products/' . $latestProduct->image) }}"
                                                                                        alt="{{ $latestProduct->alt_image }}">
                                                                                @else
                                                                                    <img class="img-fluid"
                                                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                                        alt="placeholder image">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-10">
                                                                                <div
                                                                                    class="card-body d-flex justify-content-between">
                                                                                    <div class="d-flex flex-column">
                                                                                        <h6
                                                                                            class="card-text fw-bolder text-black mb-0  form-placeholder">
                                                                                            {{ ucfirst($latestProduct->name) }}
                                                                                        </h6>
                                                                                        <p class="card-text fw-bold form-placeholder"
                                                                                            style='color: #737373;'>
                                                                                            {!! env('CURRENCY', 'PKR') . ' ' . number_format($latestProduct->original_price) !!}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <p
                                                                                            class="card-text text-danger  form-placeholder fw-bold text-decoration-underline">
                                                                                            View
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="container-fliud resp px-2" id='specs'>
                            <div class="row">
                                <div class="col-12 mt-md-5 mt-2 ps-2">
                                    <div class="row g-0">
                                        <div class="col-12 col-md-9 pe-0">
                                            @foreach (@$product->attributes as $productAttribute)
                                                <div class="row bg-light-2 me-md-3 mb-5">
                                                    <div
                                                        class="col col-md-2 col-12 d-flex justify-content-start justify-content-md-center align-items-center px-1 bg-light-3">
                                                        <div
                                                            class=" fw-semibold text-color px-md-0 pt-md-0 my-1 my-md-0 border_start">
                                                            {{ ucfirst(@$productAttribute->attribute->name ?? '-') }}
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-10 col-11 " style = "background-color:rgba(255,255,255,0.7) ">
                                                        @foreach (@$productAttribute->productAttributeValues as $value)
                                                            <div class="row  border-bottom border-light-subtle  pt-2">
                                                                <div class="col-md-4 col-lg-3 col-4 fw-bold p-1 desc-text">
                                                                    {{ ucfirst(@$value->attributeValue->value ?? '-') }}
                                                                </div>
                                                                <div
                                                                    class="col-md-8 col-lg-9 col-8  p-1 desc-text  fw-bold text-black-50">
                                                                    {{ ucfirst($value->value ?? '-') }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- <div
                                                class="col-md-8 col-lg-9 col-8 p-1 desc-text mt-5 fw-bold text-black-50">
                                                <b>Disclaimer:</b> We can not guarantee that all the details regarding this comparison is 100% correct.
                                            </div> --}}
                                        </div>
                                        @if (@$more_mobiles && count($more_mobiles) > 0)
                                            <div class="col-12 col-md-3 d-none d-md-block">
                                                <div class="col-12 d-none d-md-block">
                                                    <div class="d-flex align-items-baseline justify-content-between mt-3">
                                                        <h6
                                                            class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 side-head'>
                                                            More Mobiles
                                                        </h6>
                                                        <a href="{{ route('product-by.brand', @$product->brand->slug ?? '1') }}" class='text-danger d-flex align-items-none form-placeholder text-decoration-none'>
                                                            <p class='fw-bold'>See More</p>
                                                        </a>
                                                    </div>
                                                    <div class="row ms-1 d-md-block d-none">
                                                        <div class="col-12">
                                                            @foreach ($more_mobiles as $moreProduct)
                                                                <div
                                                                    class="card mb-2 w-100 rounded-0 p-2 px-2 px-lg-3 card-shadow">
                                                                    <div class="row g-0 align-items-center">
                                                                        <div class="col-4 d-flex mx-0 px-0">
                                                                            @if ($moreProduct->image && file_exists(public_path('uploads/products/' . $moreProduct->image)))
                                                                                <img class="img-fluid"
                                                                                    src="{{ asset('uploads/products/' . $moreProduct->image) }}"
                                                                                    alt="{{ $moreProduct->alt_image }}">
                                                                            @else
                                                                                <img class="img-fluid"
                                                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                                    alt="placeholder image">
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <div
                                                                                class="card-body py-0 my-0 d-flex flex-column gap-1 ms-2 me-0 px-0">
                                                                                <p
                                                                                    class="card-text form-placeholder  py-0 my-0 fw-bold  size-prod-text-768">
                                                                                    {{ ucfirst($moreProduct->name) }}
                                                                                </p>
                                                                                <p
                                                                                    class="card-text form-placeholder py-0 my-0 fw-semibold text-black-50 size-prod-text-768">
                                                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($moreProduct->original_price) !!}
                                                                                </p>
                                                                                <a href="{{ route('product.details', $moreProduct->slug) }}"
                                                                                    class='text-decoration-none'>
                                                                                    <small
                                                                                        class="text-danger fw-bold text-decoration-underline size-prod-text-768"
                                                                                        style="position:relative;top: -4px;">
                                                                                        Read More
                                                                                    </small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
    
    
                                        <div class="col-12 d-none d-md-block mt-3">
                                            <div class="row">
                                                <div class="col-12 mx-3">
                                                    <p class="text-muted fw-bold text-center mt-0 pt-0 mb-0 pb-0 font-sm">Advertisement 
                                                    </p>
            
                                                    <!-- Ad Container -->
                                                    <div class="ratio ratio-16x9 w-100" style='height:500px;background:rgba(0,0,0,0);'>
                                                        <!-- Google AdSense Code -->
                                                        <ins class="adsbygoogle" style="display:block"
                                                            data-ad-client="ca-pub-2933454440337038" data-ad-slot="3508854456"
                                                            data-ad-format="auto" data-full-width-responsive="true">
                                                        </ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fliud bg-white mt-5 mb-5 overflow-hidden" style='width:100vw;'>
        <div class="container">
            <div class="row justify-content-center mt-5 mb-md-5 mb-0 pb-2">
                <div class="col-md-12 col-lg-12">
                    <div class="row g-3">
                        <div
                            class="col-12 d-flex align-items-end gap-2 mt-4 mb-2 mx-2 px-3 border-start border-5 border-danger">
                            <h5 class='fw-bold heading'>Compare Your Any Mobile Phone</h5>
                        </div>
                        <div class="col-12 col-lg-6 position-relative ">
                            <i class="fas fa-search position-absolute text-black-50"
                                style="right: 25px; top: 12px; transform: translateX(50%); color: black;"></i>

                            <input type="text"
                                class="form-control p-2 py-2 fw-semibold rounded-0 form-placeholder fw-semibold focus-ring shadow-sm find_mobile_for_compare"
                                placeholder="Find Mobiles for comparing" style="width: 100%;" aria-label="Search"
                                style='height:43px; color:black;'>
                            <div class="container findMobileComparing d-none bg-light shadow position-absolute"
                                style="width: 97%; z-index:999">
                                <!-- Search results will be dynamically appended here -->
                            </div>

                            <div class="d-flex border mt-3">
                                <div class="row px-2 py-4 d-flex flex-row align-items-center ms-auto me-auto">
                                    <div class="col col-5 pe-3">
                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                            <img class="card-img-top px-md-5 px-3 pt-2"
                                                src="{{ asset('uploads/products/' . $product->image) }}"
                                                alt="{{ $product->alt_image }}">
                                        @else
                                            <img height='150' width='150'
                                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                alt="placeholder image">
                                        @endif
                                        <p class="text-center mt-2"><b>{{ ucfirst($product->name) }}</b></p>
                                    </div>
                                    <div class="col col-2 d-flex justify-content-center align-items-center">
                                        <div class="mx-4">
                                            <span
                                                class=" btn-custom d-flex justify-content-center align-items-center
                                            rounded-circle" 
                                                style='padding:11px 13px 11px 13px'>VS</span>
                                        </div>
                                    </div>
                                    <div class="col col-5 ps-3 position-relative">
                                        <button type="button" class="compare-by-mobile-close-button position-absolute top-0 end-0 m-2 border-0 d-none bg-transparent fs-4" aria-label="Close">
                                            &times;
                                        </button>
                                        <img class="searched-product-result-image card-img-top px-md-5 px-3 pt-2"
                                            src="{{ asset('assets/front/images/phoneicon.svg') }}"
                                            alt="">
                                        <p class="text-center mt-2"><b class="searched-product-result-name"></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <a href="javascript:void(0)" data-compare="false" class="btn btn-danger compare-mobile-button">Compare <b>></b></a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            @for ($i = 0; $i < count($comparing_products); $i += 2)
                                <a href="{{ route('compare-page', [
                                    'from' => $product->slug ?? '',
                                    'to' => $comparing_products[$i + 1]->slug ?? '',
                                ]) }}"
                                    class="card card-shadow mb-3 rounded-0 text-dark text-decoration-none">
                                    <div class="card-body d-flex align-items-center px-0">
                                        <div class="d-flex align-items-center ps-2 _4ksecProd pe-0 me-0"
                                            style='width:45%'>
                                            @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                <img class="img-fluid img-compare"
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="{{ $product->alt_image }}">
                                            @else
                                                <img class="img-fluid img-compare"
                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                    alt="placeholder image">
                                            @endif
                                            <div
                                                class="ms-2 d-md-block d-flex justify-content-center align-items-center  pe-0 me-0">
                                                <h6 class="fw-bold mb-2 form-placeholder w-md-100  pe-0 me-0">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                                <p
                                                    class="mb-0 fw-semibold text-black-50 form-placeholder d-none d-md-block">
                                                    {{ env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mx-0 mx-md-2 ms-3 me-3 _4kvs">
                                            <span
                                                class=" btn-custom d-flex justify-content-center align-items-center rounded-circle vs">VS</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start ps-2 ps-xl-4 _4ksecProd"
                                            style='width:45%'>
                                            @if (
                                                $comparing_products[$i + 1]->image &&
                                                    file_exists(public_path('uploads/products/' . $comparing_products[$i + 1]->image)))
                                                <img class="img-fluid img-compare"
                                                    src="{{ asset('uploads/products/' . $comparing_products[$i + 1]->image) }}"
                                                    alt="{{ $comparing_products[$i + 1]->alt_image }}">
                                            @else
                                                <img class="img-fluid img-compare"
                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                    alt="placeholder image">
                                            @endif
                                            <div class="ms-2 d-md-block d-flex justify-content-center align-items-center">
                                                <h6 class="fw-bold mb-2 form-placeholder w-md-100">
                                                    {{ ucfirst($comparing_products[$i + 1]->name) }}
                                                </h6>
                                                <p
                                                    class="mb-0 fw-semibold text-black-50 form-placeholder     d-none d-md-block">
                                                    {{ env('CURRENCY', 'PKR') . ' ' . number_format($comparing_products[$i + 1]->original_price) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container-fliud bg-light py-4 pt-5">
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-12 py-2">
                            <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4'>Mobile Information
                            </h5>
                        </div>
                        @if ($product->description != '')
                        <div class="col-12 py-2">
                            <p class='fw-semibold'>
                                <span class="short-desc">{!! $product->description !!}</span>
                            </p>
                        </div>
                        @else
                        -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mt-md-5 mt-0 mb-0 overflow-hidden" style='width:100vw;' id="opinions">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-12 py-2">
                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 heading'>{!! ucfirst($product->name ?? '-') !!} Opinions
                        </h5>
                    </div>
                    <div class="col-12 pt-4 flex-column justify-content-end align-items-start">
                        <div class="input-group">
                            <img src="{{ asset('assets/front/images/avatar.svg') }}" width='50'>
                            <input type="text" class="form-control rounded-0 product_comment" name="comment"
                                placeholder="Share us your opinion...">
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mb-4 d-flex flex-row justify-content-end">
                                <button type="button"
                                    class="btn btn-custom rounded-0 px-3 py-2 post_review_button fw-bold">Post
                                    Review</button>
                            </div>
                        </div>
                    </div>
                    <div class="product_comments_and_replies">
                        @if (@$product->comments && count($product->comments) > 0)
                            @foreach ($product->comments as $key => $comment)
                                <div class="col-12 mt-0 mb-2 flex column justify-content-end align-items start">
                                    <div class="row border-0 border-bottom justify-content-between">
                                        <div class="col-1">
                                            <img src="{{ asset('assets/front/images/avatar.svg') }}" width='75'>
                                        </div>
                                        <div class="col-md-11 col-9">
                                            <div class="row justify-content-between">
                                                <div class="col-8">
                                                    <div class="d-flex flex-column g-0">
                                                        <h6 class="mb-1">{{ ucfirst(@$comment->user->name ?? '-') }}
                                                        </h6>
                                                        <small
                                                            class="text-muted font-sm">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                                @php
                                                    $hasLiked = @$comment->likes()->whereUserId(auth()->id())->exists();
                                                    $hasDisLiked = @$comment
                                                        ->dislikes()
                                                        ->whereUserId(auth()->id())
                                                        ->exists();
                                                @endphp
                                                <div class="col-4 d-flex justify-content-end ">
                                                    <div class="d-flex align-items-center gap-2 h-100">
                                                        <button class="btn border px-md-4 px-3 mr-2 rounded-0 font-thumb"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCenter{{ $key + 1 }}">Reply</button>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <button
                                                                class="btn border font-thumb btn-sm mr-2 d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                                                data-type="comment_like"
                                                                data-comment-id="{{ $comment->id }}"
                                                                {{ @$hasLiked && $hasLiked ? 'disabled' : '' }}>
                                                                <i class="fa fa-thumbs-up"
                                                                    style="color: {{ @$hasLiked && $hasLiked ? 'red' : '' }};"></i>
                                                                <span
                                                                    class="ml-1">{{ null !== @$comment->toArray()['likes'] ? count($comment->toArray()['likes']) : '0' }}</span>
                                                            </button>
                                                            <button
                                                                class="btn border btn-sm font-thumb d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                                                data-type="comment_dislike"
                                                                data-comment-id="{{ $comment->id }}"
                                                                {{ @$hasDisLiked && $hasDisLiked ? 'disabled' : '' }}>
                                                                <i class="fa fa-thumbs-down"
                                                                    style="color: {{ @$hasDisLiked && $hasDisLiked ? 'red' : '' }};"></i>
                                                                <span
                                                                    class="ml-1">{{ null !== @$comment->toArray()['dislikes'] ? count($comment->toArray()['dislikes']) : '0' }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1 mb-0 pb-0">
                                                <div class="col-12 pb-0">
                                                    <p class='form-placeholder'>
                                                        {{ ucfirst(@$comment->comment) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- reply -->
                                @if (@$comment->replies && count($comment->replies) > 0)
                                    @foreach ($comment->replies as $reply)
                                        <div class="row mt-3 mb-0 flex column justify-content-end align-items start">
                                            <div class="col-10">
                                                <div
                                                    class="row border-0 border-bottom d-flex gap-0 justify-content-between">
                                                    <div class="col-1">
                                                        <img src="{{ asset('assets/front/images/avatar.svg') }}"
                                                            width='75'>
                                                    </div>
                                                    <div class="col-md-11 col-9">
                                                        <div class="row">
                                                            <div class="col-md-12 col-8">
                                                                <div class="d-flex flex-column g-0 ps-3">
                                                                    <h6 class="mb-1">
                                                                        {{ ucfirst(@$reply->user->name ?? '-') }}</h6>
                                                                    <small
                                                                        class="text-muted font-sm">{{ $reply->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-1 mb-0 pb-0">
                                                            <div class="col-12 pb-0 ps-4">
                                                                <p class='form-placeholder'>
                                                                    {{ ucfirst(@$reply->comment) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <!-- Reply Modal -->
                                <div class="modal fade exampleModalCenter" id="exampleModalCenter{{ $key + 1 }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Reply to:
                                                    {{ ucfirst(@$comment->user->name ?? '-') }}</h5>
                                                <span type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    X
                                                </span>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text"
                                                    class="form-control rounded-0 product_comment_reply{{ $key + 1 }}"
                                                    name="comment" placeholder="Write a reply...">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary post_reply_button"
                                                    data-key="{{ $key + 1 }}"
                                                    data-comment-id="{{ $comment->id }}">Post Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container py-4">
                    <h5 class="fw-bold border-start border-danger border-4 px-2">Web Stories</h5>
                    <div class="row g-3 pt-4">
                        @if (@$product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('product.story', $product->slug) }}" class="text-decoration-none">
                                        <div class="card mb-0 pb-0"
                                            style="border-radius: 8px;overflow: hidden;transition: transform 0.3s ease-in-out;">
                                            <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                style="width: 100%;height: 300px;object-fit: contain;">
                                            <div class="card-body d-flex justify-content-between align-items-start  mb-0 pb-0"
                                                style="padding: 12px;background: white;color: #181818;position: relative;height: 100%;display: flex;flex-direction: column;justify-content: space-between;">
                                                <div>
                                                    <h6 class="card-title fw-bolder"
                                                        style="font-size: 1.2rem;font-weight: bold;">
                                                        {!! ucfirst($product->name ?? '-') !!}</h6>
                                                    <p class="card-date fw-bold" style="font-size: 11px;color: rgba(0, 0, 0, 0.5);">
                                                        {{ date('M d, Y', strtotime($product->created_at)) }}</p>
                                                </div>
                                                <span class="share-icon"
                                                    style="position: absolute;bottom: 10px;right: 10px;font-size: 1.2rem;/* background: #181818; */border-radius: 50%;padding: 3px 9px;color: rgba(0, 0, 0, 0.5);border: 1px solid rgba(0, 0, 0, 0.2);cursor: pointer;"
                                                    onclick="shareStory(event, '{{ route('product.story', $product->slug) }}')"><i
                                                        class="fa-solid fa-share-nodes"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        @else
                            <p>Records not found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container mb-0 overflow-hidden" style='width:100vw'>
        <div class="row justify-content-center  pe-2">
            <div class="col-md-12 col-lg-12">
                @if (@$latest_mobiles && count($latest_mobiles) > 0)
                    <div class="container-fliud pt-md-4 py-4 px-md-0">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12">
                                <div class="row pt-md-4 py-4 px-md-0 px-2">
                                    <h5 class='fw-bold pt-1 border-start border-danger border-4  heading'>Popular Mobile
                                        For You
                                    </h5>
                                    <div class="container pt-4 px-0 mx-0 pe-2 pe-md-0">
                                        <div class="row g-md-1 g-2 px-0 mx-0">
                                            @foreach ($latest_mobiles as $latestProduct)
                                                <div class="col-md-3 col-6 d-flex flex-row gap-3 mb-2 mb-md-0">
                                                    <a href="{{ route('product.details', $latestProduct->slug) }}"
                                                        class='text-decoration-none'>
                                                        <div
                                                            class="card w-100 rounded-0 pt-md-2 px-md-2 px-lg-0 px-xl-1 border-secondary border-opacity-25 card-shadow">
                                                            @if ($latestProduct->image && file_exists(public_path('uploads/products/' . $latestProduct->image)))
                                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                            src="{{ asset('uploads/products/' . $latestProduct->image) }}"
                                                                    alt="{{ $product->alt_image }}">
                                                            @else
                                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2"
                                                            src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                    alt="placeholder image" style="width: 90%;  object-fit: contain;">
                                                            @endif

                                                            <div class="card-body text-center">
                                                                @if (@$latestProduct->galleries && count($latestProduct->galleries) > 0)
                                                                    <p
                                                                        class="card-text text-black-50 vertical-card fw-bold text-decoration-underline mb-2">
                                                                        View Photos({{ count($latestProduct->galleries) }})
                                                                    </p>
                                                                @endif
                                                                <h6
                                                                    class="card-text fw-bolder text-black form-placeholder">
                                                                    {{ ucfirst($latestProduct->name) }}
                                                                </h6>
                                                                <p class="card-text fw-bold form-placeholder"
                                                                    style='color: #737373;'>
                                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($latestProduct->original_price) !!}
                                                                </p>
                                                                <a href="{{ route('compare-page', ['from' => $latestProduct->slug]) }}"
                                                                    class="btn btn-custom rounded-1 h6 px-md-3 px-1 fw-semibold">
                                                                    Compare<i class="ms-1 fa-solid fa-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script-js')
    <link rel="stylesheet" href="{!! asset('assets/vendor/libs/select2/select2.css') !!}" />
    <script src="{!! asset('assets/vendor/libs/select2/select2.js') !!}"></script>

    <script type="text/javascript">
        // description toggle
        $(document).ready(function() {
            $('.toggle-desc').on('click', function() {
                var $this = $(this);
                var $fullDesc = $this.closest('div').prev().find('.full-desc');
                var $shortDesc = $this.closest('div').prev().find('.short-desc');

                if ($fullDesc.hasClass('d-none')) {
                    $shortDesc.addClass('d-none');
                    $fullDesc.removeClass('d-none');
                    $this.text('Read Less');
                } else {
                    $fullDesc.addClass('d-none');
                    $shortDesc.removeClass('d-none');
                    $this.text('Read More');
                }
            });
        });

        // post product reviews
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function postReview(data) {
            // processing ajax request    
            $.ajax({
                url: "{{ route('product.post-comment') }}",
                type: 'POST',
                dataType: "json",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.status == 1) {
                        $(".product_comment").val('');

                        if ($('.exampleModalCenter').hasClass('show')) { // Check if the modal is open
                            $('.exampleModalCenter').modal('hide'); // Close the modal
                        }

                        $('.product_comments_and_replies').html('');
                        $('.product_comments_and_replies').html(data.product_comments_and_replies);

                        toastr.success(data.message, 'Success!', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                    } else if (data.status == 0) {
                        toastr.error(data.message, 'Error!', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                    } else if (data.status == 2) {
                        toastr.info(data.message, 'Info!', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                        setTimeout(function() {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error("Something went wrong please try again later.", 'Error!', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                    }
                }
            });
        }

        // comment
        $('.post_review_button').on('click', function() {
            var data = {
                product_id: "{{ $product->id }}",
                comment: $(".product_comment").val(),
                type: 'comment'
            };

            // Call the postReview function
            postReview(data);
        });

        // reply
        $(document).on('click', '.post_reply_button', function() {
            var key = $(this).data('key');
            var commentId = $(this).data('comment-id');
            var data = {
                product_id: "{{ $product->id }}",
                product_comment_id: commentId,
                comment: $(".product_comment_reply" + key).val(),
                type: 'reply'
            };

            // Call the postReview function
            postReview(data);
        });

        // like & dislike
        $(document).on('click', '.like_and_dislike_button', function() {
            var type = $(this).data('type');
            var commentId = $(this).data('comment-id');
            var data = {
                product_id: "{{ $product->id }}",
                product_comment_id: commentId,
                type: type
            };

            // Call the postReview function
            postReview(data);
        });

        // select2
        $(".select2").each(function() {
            $(this).select2({
                placeholder: $(this).data('placeholder'),
                minimumInputLength: 2,
            });
        });

        // When an option is selected, redirect to the corresponding URL
        $('#to-product-select').on('change', function() {
            var url = $(this).val(); // Get the selected option's value (which is the URL)
            if (url) { // If a valid URL is selected
                window.location.href = url; // Redirect to the URL
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            {{-- $('.find_mobile_for_compare').on('input', function() {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('search.mobile-for-comparing') }}", // Laravel route for mobile search
                        method: 'GET',
                        data: {
                            search: query,
                            compare_from: '{{ $product->slug ?? '' }}'
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                $('.findMobileComparing').html(''); // Clear existing results
                                $('.findMobileComparing').append(response
                                    .products); // Add new results
                                $('.findMobileComparing').removeClass('d-none');
                                // $overlay.show();
                            } else if (response.status === 0) {
                                $('.findMobileComparing').html(`
                                <div class="card text-center mb-0 rounded-0 px-0 border-0 mt-5" style=" height: 160px;">
                                    <h5 class="card-title fw-bold mb-0 text-dark fs-6 fw-semibold">Records not found!</h5>
                                </div>
                            `);
                            }
                        },
                        error: function() {
                            console.log('Error fetching mobile search results');
                        }
                    });
                } else {
                    $('.findMobileComparing').addClass('d-none');
                }
            }); --}}

            let typedInstance = null;
            // Typed.js initialization
            function startTyped() {
                if (typedInstance) {
                    typedInstance.destroy(); // Destroy the old instance
                }

                typedInstance = new Typed('.find_mobile_for_compare', {
                    strings: ['Search your Phone...', 'Mobile Description...', 'Search Your Mobile Price...'],
                    typeSpeed: 50,
                    backSpeed: 25,
                    startDelay: 500,
                    backDelay: 1500,
                    loop: true,
                    attr: 'placeholder',
                    bindInputFocusEvents: true
                });
            }
            startTyped();

            // Get the list of all mobiles (this is passed from PHP)
            const allMobiles = @json($searchableProducts); // All products fetched on page load

            // When user types in the search field
            $('.find_mobile_for_compare').on('input', function() {
                const query = $(this).val().toLowerCase();

                if (query.length > 0) {
                    // Filter products client-side based on the query
                    const filteredMobiles = allMobiles.filter(mobile => {
                        return mobile.name.toLowerCase().includes(query);
                    });

                    // Render filtered results
                    displaySearchResults(filteredMobiles);
                } else {
                    // If no query, hide the results
                    $('.findMobileComparing').addClass('d-none');
                }
            });

            function displaySearchResults(mobiles) {
                const container = $('.findMobileComparing');
                container.html(''); // Clear existing results

                if (mobiles.length > 0) {
                    // Loop through the filtered results and append them to the DOM
                    mobiles.forEach(mobile => {
                        const imageUrl = mobile.image ? '{{ asset('uploads/products/') }}/' + mobile.image : 'https://via.placeholder.com/300x100.png?text=No+Image';
                        
                        const mobileHtml = `
                            {{-- <a target="_blank" href="{!! route('compare-page', ['from' => $product->slug, 'to' => '']) !!}/${mobile.slug}" class="row p-2 border border-black border-opacity-75 text-decoration-none"> --}}
                            <span
                                data-slug="${mobile.slug}"
                                data-image="${imageUrl}"
                                data-name="${mobile.name}"
                                style="cursor: pointer;"
                                class="row p-2 border border-black border-opacity-75 text-decoration-none searched-product">
                                <div class="col-3 d-flex justify-content-center">
                                    <img src="${imageUrl}" style="width:40%;">
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <p class="fw-semibold text-dark form-placeholder">${mobile.name}</p>
                                </div>
                            </span>
                            {{-- </a> --}}
                        `;
                        container.append(mobileHtml);
                    });
                    container.removeClass('d-none'); // Show the results container
                } else {
                    container.html(`
                        <div class="card text-center mb-0 rounded-0 px-0 border-0 mt-5" style=" height: 160px;">
                            <h5 class="card-title fw-bold mb-0 text-dark fs-6 fw-semibold">Records not found!</h5>
                        </div>
                    `);
                }
            }

            // click on searched product, then show in a container
            $(document).on('click', '.searched-product', function() {
                var result = $(this);
                var name = result.data('name');
                var image = result.data('image');
                var slug = result.data('slug');

                // dynamic compare by mobile details
                $('.searched-product-result-image').attr('src', image);
                $('.searched-product-result-name').text(name);
                $('.compare-mobile-button').attr('href', "{!! route('compare-page', ['from' => $product->slug, 'to' => '']) !!}/" + slug).attr('data-compare', true);
                $('.find_mobile_for_compare').css('border', '');
                $('.compare-by-mobile-close-button').removeClass('d-none');

                // hide search bar
                $('.findMobileComparing').addClass('d-none');
                $('.find_mobile_for_compare').val('');
                startTyped();
            });

            // redirect to compare page for comparing
            $('.compare-mobile-button').on('click', function() {
                var compare_mobile_button = $(this);
                var compare_status = compare_mobile_button.data('compare');

                if (compare_status == false) {
                    $('.find_mobile_for_compare').css('border', '2px solid red');
                } else {
                    $('.find_mobile_for_compare').css('border', '');
                }
            });

            // remove compare by mobile from compare mobile section
            $('.compare-by-mobile-close-button').on('click', function() {
                $('.searched-product-result-image').attr('src', "{{ asset('assets/front/images/phoneicon.svg') }}");
                $('.searched-product-result-name').text('');
                $('.compare-mobile-button').attr('href', "javascript:void(0)").attr('data-compare', false);
                $('.compare-by-mobile-close-button').addClass('d-none');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        {{-- var typed = new Typed('.find_mobile_for_compare', {
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
        }); --}}
    </script>
    <script>
        document.getElementById('share-icon').addEventListener('click', function() {
            const url = window.location.href;
            navigator.clipboard.writeText(url)
                .then(() => {
                    alert('Link copied to clipboard!');
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        });
    </script>
@endsection
