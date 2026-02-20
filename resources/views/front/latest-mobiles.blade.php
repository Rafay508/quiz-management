@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')
<div class="container-fliud my-4 margin">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="row py-4 px-1">
                            <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4'>
                                {{ 'Latest Mobiles' }}
                            </h5>
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
                                        {{-- <div class="pagination">
                                            {{ $products->links('pagination::bootstrap-4') }}
                                        </div> --}}
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
