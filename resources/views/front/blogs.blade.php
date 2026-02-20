@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('header')
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

<!-- AMP Boilerplate Styles -->
<style amp-boilerplate>
    body {
        visibility: hidden;
    }
    @keyframes -amp-start {
        from { visibility: hidden; }
        to { visibility: visible; }
    }
</style>

<!-- AMP NoScript Styles for non-JavaScript users -->
<noscript>
    <style amp-boilerplate>
        body { visibility: visible; }
    </style>
</noscript>

<!-- AMP JS Script -->
<script async src="https://cdn.ampproject.org/v0.js"></script>
@endsection

@section('content')
<div class="container my-4 mb-md-5 margin overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="container-fliud mb-4 mt-3">
            @include('front.layouts.partials.head-ad')
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="row g-0">
                <div class="col-md-9 col-12">
                    <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-md-3 mb-3 heading'>Recent Posts
                    </h5>
                    <div class="row px-md-3">
                        <div class="col-12">
                            @if (@$blogs && count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <div class="card mb-3 w-100 rounded-0 card-shadow px-0 mx-0">
                                        <div class="row g-0 p-md-4 p-2 align-items-center">
                                            <div class="col-md-3 col-4">
                                                @if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                                                    <img class="img-fluid" src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->alt_image }}">
                                                @else
                                                    <img class="img-fluid"
                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                        alt="placeholder image">
                                                @endif
                                            </div>
                                            <div class="col-md-9 col-8">
                                                <div class="card-body my-0 py-0 me-0 pe-0">
                                                    <p class='card-text py-0 my-0 mb-md-1'>
                                                        <small class='text-black-50 fw-semibold blog-sm'>Blogging</small>
                                                    </p>
                                                    <h5 class="card-title my-0 fw-semibold mb-md-1 blog-lg text-hover">
                                                        {{ Str::limit($blog->name, 50) }}
                                                    </h5>
                                                    <div class="d-flex align-items-center gap-md-3 gap-1 py-0 my-0 mb-md-1">
                                                        <div class="card-text blog-sm text-black-50"><small class='fw-bold'>{{ $blog->created_at->format('M d, Y') }}</small></div>
                                                        <span class='rounded-circle' style='background-color:blue; width: 5px;height: 5px;'></span>
                                                        <div class="card-text blog-sm text-black-50"><small class=' fw-bold'>{{ $blog->clicks ?? '0' }} Views</small></div>
                                                    </div>
                                                    <p class="card-text blog-sm">
                                                        <a href="{{ route('blog-details', $blog->slug) }}" class='text-decoration-none'>
                                                            <small class="text-danger fw-bold text-decoration-none"
                                                                style="position:relative;top: -3px;">
                                                                Read More
                                                            </small>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="pagination">
                                    {{ $blogs->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-none d-md-block">
                    {{-- <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 fs-6'>Tech News</h5>
                        <a href="#" class='text-danger d-flex align-items-none text-decoration-none form-placeholder'>
                            <p class='fw-bold'>See More</p>
                        </a>
                    </div>

                    <div class="row ms-1">
                        <div class="col-12">
                            @if (@$blogs && count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <div class="card mb-2 w-100 rounded-0 p-2 card-shadow">
                                        <div class="row g-0 align-items-center py-3">
                                            <div class="col-md-5 col-5">
                                                @if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                                                    <img class="img-fluid" src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->alt_image }}">
                                                @else
                                                    <img class="img-fluid"
                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                        alt="placeholder image">
                                                @endif
                                            </div>
                                            <div class="col-md-7 col-7">
                                                <div class="card-body py-0 my-0 pe-0 me-0">
                                                    <p class="card-text form-placeholder">
                                                        <a href="{{ route('blog-details', $blog->slug) }}" class="text-decoration-none text-dark  fw-semibold">
                                                            {{ Str::limit($blog->name, '40', '...') }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div> --}}

                    <!-- middle ads -->
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

                    <div class="d-flex align-items-baseline justify-content-between mt-3">
                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 fs-6'>More Mobiles</h5>
                        <a href="#" class='text-danger d-flex align-items-none text-decoration-none form-placeholder'>
                            <p class='fw-bold'>See More</p>
                        </a>
                    </div>
                    <div class="row ms-1 d-md-block d-none">
                        <div class="col-12">
                            @if (@$products && count($products) > 0)
                                @foreach ($products->take(4) as $product)
                                    <div class="card mb-2 w-100 rounded-0 p-2 px-3 card-shadow">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4">
                                                @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                    <img class="img-fluid"
                                                         src="{{ asset('uploads/products/' . $product->image) }}"
                                                         alt="{{ $product->alt_image }}"
                                                         style="width: 100%; height: auto;">
                                                @else
                                                    <img class="img-fluid"
                                                         src="https://placehold.co/400"
                                                         alt="placeholder image"
                                                         style="width: 100%; height: auto;">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body py-0 my-0 d-flex flex-column gap-1">
                                                    <p class="card-text form-placeholder py-0 my-0 fw-bold">
                                                        {{ ucfirst($product->name) }}
                                                    </p>
                                                    <p class="card-text form-placeholder py-0 my-0 fw-semibold text-black-50">
                                                        {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                    </p>
                                                    <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                                        <small class="text-danger fw-bold text-decoration-underline"
                                                               style="position:relative;top: -4px;">
                                                            Read More
                                                        </small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div class="row g-md-4 g-2 d-md-none">
                        @if (@$products && count($products) > 0)
                            @foreach ($products->take(4) as $product)
                                <div class="col-md-3 col-6 d-flex flex-row gap-3">
                                    <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none'>
                                        <div
                                            class="card rounded-0 pt-2 px-md-0 px-lg-0 px-xl-4 border-secondary border-opacity-25 card-shadow">
                                                @if ($product->image &&
                                                file_exists(public_path('uploads/products/' . $product->image))
                                                )
                                                    <img class="card-img-top px-md-4 px-2 pt-2 prod-img"
                                                        src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->alt_image }}">
                                                @else
                                                    <img class="card-img-top px-md-4 px-2 pt-2 prod-img"
                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                        alt="placeholder image">
                                                @endif
                                            <div class="card-body text-center">
                                                <p
                                                    class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline">
                                                    View Photos(5)</p>
                                                <h6 class="card-text fw-bolder text-black product-font">
                                                    {{ ucfirst($product->name) }}
                                                </h6>
                                                <p class="card-text fw-bold product-price" style='color: #737373;'>
                                                    {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                </p>
                                                <div class="btn btn-custom rounded-1 product-font px-md-3 px-3 fw-semibold">
                                                    Compare<i class="ms-1 fa-solid fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="d-md-flex align-items-baseline justify-content-between mt-3 d-none">
                        <h5 class='fw-bold px-2 py-1 border-start border-danger border-4 mx-3 fs-5'>Browse By Budget
                        </h5>
                    </div>
                    <div class="row g-md-1 g-3 ms-2 me-0 pe-0 flex-md-row d-none d-md-flex" style='position:relative; left:5px;'>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 15000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 15,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 25000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 25,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 35000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 35,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 45000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 45,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 65000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 65,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 85000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 85,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('filter-mobile', ['budget' => 115000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder  rounded-1">
                                    Under 115,000
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
