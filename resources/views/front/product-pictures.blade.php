@extends('front.layouts.app')
@section('title', ucfirst('Pictures - ' . $product->name) . ' Pictures')

@section('content')
 <div class="container-fliud my-md-4 mb-5 margin">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="container pb-md-4 pb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="row pb-md-4 px-1">
                                <div class="col-12 d-flex align-items-center gap-1 d-none d-md-flex mb-0 pb-0">
                                    <p class="form-placeholder text-black-50 fw-semibold">
                                        <a class="text-decoration-none text-black-50 fw-semibold" href="{{ route('home') }}">
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
                                    </a>
                                </p>
                                <p class="form-placeholder text-black-50 fw-semibold">{!! ucfirst($product->name ?? '-') !!}
                                    <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                                </p>
                                <p class='form-placeholder text-black-50 fw-semibold'>Picture</p>
                                @if (@$product->brand->reference_link)
                                    <div class="d-flex ms-auto pb-3 align-items-center">
                                        @if (@$product->brand->image && file_exists(public_path('uploads/brands/' . $product->brand->image)))
                                            <img class=''
                                                style=" width: 50px;height: 50px;border-radius: 50%;object-fit: contain;"
                                                src="{{ asset('uploads/brands/' . $product->brand->image) }}"
                                                alt="{{ @$product->brand->alt_image }}">
                                        @else
                                            <img class='img-fluid'
                                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                alt="placeholder image">
                                        @endif
                                        <a href="{{ @$product->brand->reference_link }}"
                                            class='text-black-50 ms-2 fw-semibold form-placeholder'
                                            style='position:relative;top:-5px;'>
                                            {{ @$product->brand->name }} Official Website
                                        </a>

                                    </div>

                                @endif
                            </div>
                            <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4'>
                                {{ ucfirst($product->name) . ' Pictures' }}
                            </h5>
                            <div class="container pt-md-4">
                                {{-- ======= Picture Gallery ======= --}}
                                <div class="row mt-4">
                                    <div class="col-12">
                                        @if (!empty($pictures) && count($pictures) > 0)
                                            <!-- Use Bootstrap’s row-cols for a responsive grid -->
                                            <div class="row g-3">
                                                @foreach ($pictures as $picture)
                                                    <div class=" col-md-6 col-12">
                                                        <div
                                                            class="card h-100 border-secondary border-opacity-25 card-shadow">
                                                            @if ($picture->image && file_exists(public_path('uploads/products/' . $picture->image)))
                                                                <a href="{{ asset('uploads/products/' . $picture->image) }}"
                                                                    data-lightbox="product-gallery"
                                                                    data-title="{{ $picture->alt_image ?? 'Picture' }}">
                                                                    <img class="card-img-top"
                                                                        src="{{ asset('uploads/products/' . $picture->image) }}"
                                                                        alt="{{ $picture->alt_image ?? 'Picture' }}"
                                                                        style="object-fit: contain; max-height: 400px;">
                                                                </a>
                                                            @else
                                                                <img class="card-img-top"
                                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                    alt="placeholder image"
                                                                    style="object-fit: contain; max-height: 220px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <p class="text-muted mt-3">No pictures found.</p>
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
</div>
@endsection

 @section('script')
 <script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fadeDuration': 300
    })
</script>
 @endsection