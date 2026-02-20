@extends('front.layouts.app')
@section('title', @$brand->meta_title ?? 'Default Title')

@section('content')
<div class="container-fliud my-4 margin overflow-hidden" style="width:100vw">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="container pb-4">
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
                            href="{{ route('product-by.brand', $brand->slug) }}">
                             {!! ucfirst($brand->name ?? '-') !!}
                            <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                        </a>
                    </p>

                    @if ($brand->reference_link)
                    <div class="d-flex ms-auto pb-3 align-items-center">
                        @if ($brand->image && file_exists(public_path('uploads/brands/' . $brand->image)))
                        <img class='' style=" width: 50px;height: 50px;border-radius: 50%;object-fit: contain;"
                            src="{{ asset('uploads/brands/' . $brand->image) }}"
                            alt="{{ $brand->alt_image }}">
                    @else
                        <img class='img-fluid'
                            src="https://via.placeholder.com/300x100.png?text=No+Image"
                            alt="placeholder image">
                    @endif
                            <a href="{{ $brand->reference_link }}" class='text-muted ms-auto fw-semibold form-placeholder'
                                style='position:relative;top:-5px;'>
                                {{ $brand->name }} Website
                            </a>

                    </div>

                    @endif 
                </div>

                <div class="container-fliud mb-1">
                    @include('front.layouts.partials.head-ad')
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="row py-4 px-1">
                                                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4'>
                                {{ ucfirst($brand->name ?? '-') . ' Mobiles' }}
                            </h5>

                            {{-- @if ($brand->reference_link)
                                <a href="{{ $brand->reference_link }}" class='text-muted ms-auto pb-3 fw-semibold'
                                    style='position:relative;top:-5px;'>
                                    {{ @$product->brand->name }} Website
                                </a>
                                @if ($brand->image && file_exists(public_path('uploads/brands/' . $brand->image)))
                                    <img class='' style=" width: 30px;height: 30px;border-radius: 50%;object-fit: cover;"
                                        src="{{ asset('uploads/brands/' . $brand->image) }}"
                                        alt="{{ $brand->alt_image }}">
                                @else
                                    <img class='img-fluid'
                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                        alt="placeholder image">
                                @endif
                            @endif --}}

                            <div class="container pt-4">
                                <div class="row g-md-4 g-2">
                                    @if (@$products && count($products) > 0)
                                        @foreach ($products as $product)
                                            <div class="col-md-3 col-6 d-flex flex-row gap-3">
                                                <a href="{{ route('product.details', $product->slug) }}" class='text-decoration-none w-100'>
                                                    <div class="card rounded-0 pt-2 border-secondary border-opacity-25 card-shadow">
                                                        <!-- Product Image -->
                                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 prod-img"
                                                                src="{{ asset('uploads/products/' . $product->image) }}" alt="image">
                                                        @else
                                                            <img class="card-img-top px-md-5 px-3 pt-2"
                                                                src="https://via.placeholder.com/300x100.png?text=No+Image" alt="No image available">
                                                        @endif
                                                        <!-- Card Body -->
                                                        <div class="card-body text-center px-0">
                                                            <div class="d-flex justify-content-center gap-1 mt-2 mb-2">
                                                                @if (@$product->galleries && count($product->galleries) > 0)
                                                                    @php
                                                                        $totalImages = count($product->galleries);
                                                                        $maxVisibleImages = 2;
                                                                        $remainingImages = $totalImages - $maxVisibleImages;
                                                                    @endphp

                                                                    @foreach ($product->galleries as $index => $gallery)
                                                                        @if ($gallery->image && file_exists(public_path('uploads/products/' . $gallery->image)))
                                                                            @if ($index < $maxVisibleImages)
                                                                                <!-- Show the first 4 images -->
                                                                                <img src="{{ asset('uploads/products/' . $gallery->image) }}" alt="{{ $product->image }}" class="img-thumbnail border">
                                                                            @elseif ($index == $maxVisibleImages)
                                                                                <!-- Show the 5th image with the +badge -->
                                                                                <div class="position-relative">
                                                                                    <img src="{{ asset('uploads/products/' . $gallery->image) }}" alt="thumb{{ $index + 1 }}" class="img-thumbnail border">
                                                                                    <div class="plus-badge">+{{ $remainingImages }}</div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            <!-- Product Name -->
                                                            <h6 class="card-text fw-bolder text-black product-font mb-2">
                                                                {{ ucfirst($product->name) }}
                                                            </h6>

                                                            <!-- Product Price -->
                                                            <p class="card-text fw-bold product-price mt-0 mb-2" style='color: #737373;'>
                                                                {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                        <div class="pagination">
                                            {{ $products->links('pagination::bootstrap-4') }}
                                        </div>
                                    @else
                                        <p>{{ 'Records not found!' }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
