@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')
<div class="container-fliud my-4 margin overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="row py-4 px-1">
                            <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4'>
                                {{ env('APP_NAME') . ' Privacy Policy' }}
                            </h5>
                            <div class="container pt-4">
                                <div class="row g-md-4 g-2">
                                    @if(@$siteSettings && $siteSettings->privacy_policy != '')
                                        {!! $siteSettings->privacy_policy !!}
                                    @else
                                        -
                                    @endif
                                    {{-- @if (@$products && count($products) > 0)
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
                                                                <!-- Thumbnail 1 -->
                                                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="thumb1" class="img-thumbnail border">

                                                                <!-- Thumbnail 2 -->
                                                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="thumb2" class="img-thumbnail border">

                                                                <!-- Thumbnail 3 with +5 overlay -->
                                                                <div class="position-relative">
                                                                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="thumb3" class="img-thumbnail border">
                                                                    <div class="plus-badge">+5</div>
                                                                </div>
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
                                    @else
                                        <p>{{ 'Records not found!' }}</p>
                                    @endif --}}
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
