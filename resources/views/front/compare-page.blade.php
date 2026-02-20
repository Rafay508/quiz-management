@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')
<div class="container mt-4 margin" style="width: 100vw; overflow-x: hidden;">
    <div class="row justify-content-center   pe-2">
        <div class="col-md-12 col-lg-12">
            <div class="row gap-2 ms-0">
                <h5 class='fw-bold px-md-4 pt-1 border-start border-md-none border-4 border-danger px-2 my-3 heading'>
                    Mobile Comparisons For You</h5>
                    <div class="col-12">
                <div class="row">
                    <div class="col-6 pe-3">
                        <div class="row bg-light pt-4 pb-3  me-md-2">
                            <h5 class='fw-semibold  text-center font-compare-head'>Compare From</h5>
                            <div class="container-fliud">
                                <input type="text" class="form-control p-2 py-2 fw-semibold rounded-0 form-placeholder fw-semibold focus-ring shadow-sm product_compare_from"
                                    placeholder="Find Mobile..." aria-label="Search" style='height:43px; color:black;' value="{{ ucfirst($compareFromProductName->name ?? '') }}">
                                <div class="container productCompareFromSection d-none bg-light shadow position-absolute"
                                style="width:37.5%; z-index:999">
                                    <!-- Search results will be dynamically appended here -->
                                </div>
                            </div>
                            <div class="text-danger form-placeholder mt-2 font-warn-comp"><span class='fs-5'>&#128712 </span>
                                Please Enter Model Name to Compare</div>
                        </div>
                        <div class="row mt-3 me-md-2">
                            <div class="col-12 d-flex justify-content-center border-comp">
                                <div class="card border-0 mt-3   comp-card">

                                    @if (@$from_mobile->image && file_exists(public_path('uploads/products/' .
                                    $from_mobile->image)) )
                                    <img class="card-img-top  comp-card-img"
                                        src="{{ asset('uploads/products/' . $from_mobile->image) }}"
                                        alt="{{ $from_mobile->alt_image }}">
                                    @else
                                    <img class="card-img-top  comp-card-img"
                                        src="{{ asset('assets/front/images/phoneicon.svg') }}"
                                        alt="placeholder image">
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-text h6 fw-bold text-comp-name">{!! ucfirst(@$from_mobile->name ?? '-') !!}</h5>
                                        <p class="card-text fw-bold  text-danger">
                                            @if (@$from_mobile->original_price)
                                                {{ env('CURRENCY', 'RS') . ' ' . number_format($from_mobile->original_price) }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center border-md-solid d-flex d-md-block relative-btns">
                                <div class="row">
                                    <!-- Specs button, hidden on mobile -->
                                    <div class="col p-1 p-md-2 border d-none d-md-block bg-comp-btns">
                                        <a href="javascript:void(0)" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Specs</div>
                                        </a>
                                    </div>
                                    
                                    <!-- Pictures button, takes full width on mobile (col-12) -->
                                    <div class="col-12 col-md px-5 py-1 p-md-2 border bg-comp-btns">
                                        <a href="{{ @$from ? route('product.pictures', @$from) : 'javascript:void(0)' }}" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Pictures</div>
                                        </a>
                                    </div>
                                    
                                    <!-- Opinion button, hidden on mobile -->
                                    <div class="col p-1 p-md-2 border bg-comp-btns mt-1 mt-md-0 d-none d-md-block">
                                        <a href="javascript:void(0)" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Opinion</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 ps-3">
                        <div class="row bg-light pt-4 pb-3  me-md-2">
                            <h5 class='fw-semibold  text-center font-compare-head'>Compare With</h5>
                            <div class="container-fliud">
                                <input type="text" class="form-control p-2 py-2 fw-semibold rounded-0 form-placeholder fw-semibold focus-ring shadow-sm product_compare_to"
                                    placeholder="Find Mobile..." aria-label="Search" style='height:43px; color:black;' value="{{ ucfirst($compareToProductName->name ?? '') }}" {{ @$from == '' ? 'disabled' : '' }}>
                                <div class="container productCompareToSection d-none bg-light shadow position-absolute"
                                style="width:37.5%; z-index:999">
                                    <!-- Search results will be dynamically appended here -->
                                </div>
                            </div>
                            <div class="text-danger form-placeholder mt-2 font-warn-comp"><span class='fs-5'>&#128712 </span>
                                Please Enter Model Name to Compare</div>
                        </div>
                        <div class="row mt-3 me-md-2">
                            <div class="col-12 d-flex justify-content-center  border-comp">
                                <div class="card border-0 mt-3 comp-card">

                                    @if (@$to_mobile->image && file_exists(public_path('uploads/products/' .
                                    $to_mobile->image)) )
                                    <img class="card-img-top  comp-card-img"
                                        src="{{ asset('uploads/products/' . $to_mobile->image) }}"
                                        alt="{{ $to_mobile->alt_image }}">
                                    @else
                                    <img class="card-img-top  comp-card-img"
                                        src="{{ asset('assets/front/images/phoneicon.svg') }}"
                                        alt="placeholder image">
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-text h6 fw-bold  text-comp-name">{!! ucfirst(@$to_mobile->name ?? '-') !!}</h5>
                                        <p class="card-text  fw-bold  text-danger">
                                            @if (@$to_mobile->original_price)
                                                {{ env('CURRENCY', 'RS') . ' ' . number_format($to_mobile->original_price) }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center border-md-solid d-flex d-md-block relative-btns">
                                <div class="row">
                                    <div class="col p-1 p-md-2 border d-none d-md-block  bg-comp-btns">
                                        <a href="javascript:void(0)" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Specs
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-1 p-md-2 px-5 py-1 border bg-comp-btns">
                                        <a href="{{ @$from ? route('product.pictures', @$to) : 'javascript:void(0)' }}" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Pictures
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-1 p-md-2 border bg-comp-btns mt-md-0 mt-1 d-none d-md-block">
                                        <a href="javascript:void(0)" class='text-decoration-none text-dark'>
                                            <div class="p-1 fw-semibold">Opinion
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-12 my-3">
                    <div class="col-12 mt-4 mb-3">
                        <div class="row">
                            @if ((@$from_mobile->attributes && @$from_mobile->attributes != '') && count($from_mobile->attributes) > 0)
                            @foreach (@$from_mobile->attributes as $index => $fromMobileAttribute)
                                <div class="col col-md-2 col-12 d-flex justify-content-start align-items-end justify-content-md-center align-items-md-center  bg-light-3 mt-5 mt-md-3 px-0 mx-0">
                                    <div class=" fw-bold text-color border_start px-md-2 my-1 my-md-0 mx-0">
                                        {{ ucfirst(@$fromMobileAttribute->attribute->name ?? '-') }}
                                    </div>
                                </div>
                                <div class="col col-md-10 col-12 px-md-4 ps-2 pe-3 bg-light-2  mt-md-3">
                                    @foreach (@$fromMobileAttribute->productAttributeValues as $valueIndex => $value)
                                        <div class="row border-bottom border-light-subtle t-2">
                                            <div class="col-md-2 col-4 fw-semibold p-1" style='font-size:15px;'>
                                                {{ ucfirst(@$value->attributeValue->value ?? '-') }}
                                            </div>
                                            <div class="col-md-5 col-4 p-1 pe-2" style='font-size:15px;'>
                                                {{ ucfirst($value->value ?? '-') }}
                                            </div>
                                            <div class="col-md-5 col-4 p-1 pe-3" style='font-size:15px;'>
                                                <!-- to mobile data should be here -->
                                                @if(isset($to_mobile->attributes[$index]->productAttributeValues[$valueIndex]))
                                                    {{ ucfirst(@$to_mobile->attributes[$index]->productAttributeValues[$valueIndex]->value ?? '-') }}
                                                @else
                                                    <!-- Fallback if no data for the "to" mobile -->
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            @else
                                <p>Records not found!</p>
                            @endif
                        </div>
                        <div
                            class="col-md-8 col-lg-9 col-8 p-1 desc-text mt-5 fw-bold text-black-50">
                            <b>Disclaimer:</b> We can not guarantee that all the details regarding this comparison is 100% correct.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (@$trending_products && count($trending_products) > 0)
    <div class="container py-4 px-md-3">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="row py-4 px-md-1 px-3">
                    <h5 class='fw-bold pt-1 border-start border-danger border-4 heading'>Popular Mobile For You
                    </h5>
                    <div class="container py-4">
                        <div class="row g-md-4 g-1">
                            @foreach ($trending_products->take(4) as $trendingProduct)
                            <div class="col-md-3 col-6 d-flex flex-row gap-0">
                                <a href="{{ route('product.details', $trendingProduct->slug) }}" class='text-decoration-none'>
                                    <div
                                        class="card w-100 rounded-0 px-md-2 px-lg-0 px-xl-1 border-secondary border-opacity-25 card-shadow">
                                        @if ($trendingProduct->image &&
                                        file_exists(public_path('uploads/products/' . $trendingProduct->image))
                                        )
                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                src="{{ asset('uploads/products/' . $trendingProduct->image) }}" alt="{{ $trendingProduct->alt_image }}">
                                        @else
                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                alt="placeholder image">
                                        @endif

                                        <div class="card-body text-center">
                                            @if (@$product->galleries && count($product->galleries) > 0)
                                            <p
                                                class="card-text text-black-50 vertical-card form-placeholder fw-bold text-decoration-underline mb-2">
                                                View Photos({{ count($product->galleries) }})
                                            </p>
                                            @endif
                                            <h6 class="card-text fw-bolder text-black product-font">
                                                {{ ucfirst($trendingProduct->name) }}
                                            </h6>
                                            <p class="card-text fw-bold product-price" style='color: #737373;'>
                                                {!! env('CURRENCY', 'PKR') . ' ' . number_format($trendingProduct->original_price) !!}
                                            </p>
                                            <a href="{{ route('compare-page', ['from' => $trendingProduct->slug]) }}"
                                                class="btn btn-custom rounded-1 form-placeholder px-md-3 px-3 fw-semibold">
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
@endsection

@section('script-js')
<link rel="stylesheet" href="{!! asset('assets/vendor/libs/select2/select2.css') !!}" />
<script src="{!! asset('assets/vendor/libs/select2/select2.js') !!}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.product_compare_from').on('input', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search.product-compare-from') }}", // Laravel route for mobile search
                    method: 'GET',
                    data: {
                        search: query,
                        compare_to: '{{ $to ?? '' }}'
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            $('.productCompareFromSection').html(''); // Clear existing results
                            $('.productCompareFromSection').append(response.products); // Add new results
                            $('.productCompareFromSection').removeClass('d-none');
                            // $overlay.show();
                        } else if (response.status === 0) {
                            $('.productCompareFromSection').html(`
                                <div class="card text-center mb-0 rounded-0 px-0 border-0 mt-5" style="width: 140px; height: 160px;">
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
                $('.productCompareFromSection').addClass('d-none');
            }
        });
    });
    $(document).ready(function() {
        $('.product_compare_to').on('input', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search.product-compare-to') }}", // Laravel route for mobile search
                    method: 'GET',
                    data: {
                        search: query,
                        compare_from: '{{ $from ?? '' }}'
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            $('.productCompareToSection').html(''); // Clear existing results
                            $('.productCompareToSection').append(response.products); // Add new results
                            $('.productCompareToSection').removeClass('d-none');
                            // $overlay.show();
                        } else if (response.status === 0) {
                            $('.productCompareToSection').html(`
                                <div class="card text-center mb-0 rounded-0 px-0 border-0 mt-5" style="width: 140px; height: 160px;">
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
                $('.productCompareToSection').addClass('d-none');
            }
        });
    });
</script>
@endsection
