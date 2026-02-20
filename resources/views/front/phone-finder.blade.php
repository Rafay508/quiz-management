@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')
<div class="col-12 mt-5 mt-md-5 mb-0 margin">
    @include('front.layouts.partials.head-ad')
</div>
<form action="{{ route('filter-mobile') }}" method="GET" class="container  overflow-hidden" style='width:100vw'>
    <h5 class='fw-bold px-2 py-1 border-start border-danger border-4 heading mt-md-4 mb-3'>
        Softliee Phone Finder
    </h5>
    <div class="row justify-content-center bg-light mb-3 mx-0">
        <div class="col-md-12 col-lg-12">
            
            <div class="container-fliud d-flex justify-content-center">
                <div class="col-md-7 col-12">
                    <div class="container p-2 py-md-4 py-2 ps-md-1 pe-md-5 px-md-3 px-0 d-flex flex-column gap-md-3 gap-1 mt-md-4 mt-2">
                        <h4 class='text-center fw-semibold finder-title'>Choose a Price Range</h4>
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
                        <div class="slider-container mt-2" style="position: relative; width: 100%; height: 30px; top: 15px;">
                            <div class="slider-track accent-color">
                            </div>
                            <input class='range range-1' type="range" min="0" max="1000000" value="0" id="slider-1">
                            <input class='range range-2' type="range" min="0" max="1000000" value="1000000"
                                id="slider-2">
                            <div class="values d-none">Value</div>
                        </div>
                        <button type="submit" class="btn btn-custom rounded-1 py-2 fw-bold focus-shadow text-center d-flex align-items-center justify-content-center btn-find mt-4 mt-md-0"
                            onclick="this.classList.toggle('nav-shadow')">Find Mobile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fliud">
        <div class="row justify-content-between">
            <div class="col-12 col-md-12">
                <div class="mb-2 bg-light p-3 px-3">
                    <label for="brand-name" class="form-label finder-head fw-semibold mb-3">Select Brand</label>
                    <select class="form-select form-select rounded-0  finder-head2 select2" name="brand" id="brand-name">
                        <option value="" selected>Please select brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ ucfirst($brand->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="mb-2 bg-light p-2 px-3">
                    <p class="finder-head fw-semibold">Select Market Status</p>
                    <div class="d-grid market-status-grid">
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="status" id="Available"
                                value="Available">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Available">Available</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="status" id="ComingSoon"
                                value="Coming Soon">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="ComingSoon">Coming Soon</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="status" id="Discontinued"
                                value="Discontinued">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Discontinued">Discontinued</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (@$phoneFinerCustomization->ram)
    <div class="container-fluid bg-light mb-2">
        <div class="row justify-content-between">
            <div class="col-12 col-md-12">
                <div class="bg-light p-2 px-md-3 px-0">
                    <p class='fw-semibold finder-head'>RAM</p>
                    <div class="d-grid ram-selection-grid">
                        {{-- <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="1GB" value="1">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="1GB">1 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="2GB" value="2">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="2GB">2 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="3GB" value="3">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="3GB">3 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="4GB" value="4">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="4GB">4 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="5GB" value="5">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="5GB">5 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="6GB" value="6">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="6GB">6 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="7GB" value="7">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="7GB">7 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="ram" id="8GB" value="8">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="8GB">8 GB</label>
                        </div> --}}
                        @php($rams = explode(',', $phoneFinerCustomization->ram))
                        @foreach ($rams as $ram)
                            <div class="form-check p-0">
                                <input class="form-check-input d-none" type="radio" name="ram" id="{{ $ram }}GB" value="{{ $ram }}">
                                <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="{{ $ram }}GB">{{ $ram }} GB</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (@$phoneFinerCustomization->storage)
    <div class="container-fluid bg-light mb-2">
        <div class="row justify-content-between">
            <div class="col-12 col-md-12">
                <div class="bg-light p-2 px-md-3 px-0">
                    <p class='fw-semibold finder-head'>Storage</p>
                    <div class="d-grid ram-selection-grid">
                        {{-- <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="16GB" value="16">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="16GB">16 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="32GB" value="32">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="32GB">32 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="64GB" value="64">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="64GB">64 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="128GB" value="128">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="128GB">128 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="256GB" value="256">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="256GB">256 GB</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="storage" id="512GB" value="512">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="512GB">512 GB</label>
                        </div> --}}
                        @php($storages = explode(',', $phoneFinerCustomization->storage))
                        @foreach ($storages as $storage)
                            <div class="form-check p-0">
                                <input class="form-check-input d-none" type="radio" name="storage" id="{{ $storage }}GB" value="{{ $storage }}">
                                <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="{{ $storage }}GB">{{ $storage }} GB</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (@$phoneFinerCustomization->front_camera)
    <div class="container-fluid bg-light mb-2">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="bg-light p-2 px-3">
                    <p class='fw-semibold finder-head'>Front Camera</p>
                    <div class="d-grid camera-selection-grid">
                        {{-- <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front12MP" value="12">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front12MP">12 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front13MP" value="13">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front13MP">13 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front16MP" value="16">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front16MP">16 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front32MP" value="32">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front32MP">32 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front48MP" value="48">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front48MP">48 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front50MP" value="50">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front50MP">50 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front64MP" value="64">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front64MP">64 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="front_camera" id="Front108MP" value="108">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front108MP">108 MP</label>
                        </div> --}}
                        @php($frontCamera = explode(',', $phoneFinerCustomization->front_camera))
                        @foreach ($frontCamera as $front_camera)
                            <div class="form-check p-0">
                                <input class="form-check-input d-none" type="radio" name="front_camera" id="Front{{ $front_camera }}MP" value="{{ $front_camera }}">
                                <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="Front{{ $front_camera }}MP">{{ $front_camera }} MP</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (@$phoneFinerCustomization->back_camera)
    <div class="container-fluid bg-light mb-2">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="bg-light p-2 px-3">
                    <p class='fw-semibold finder-head'>Back Camera</p>
                    <div class="d-grid camera-selection-grid">
                        {{-- <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="12MP" value="12">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="12MP">12 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="13MP" value="13">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="13MP">13 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="16MP" value="16">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="16MP">16 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="32MP" value="32">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="32MP">32 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="48MP" value="48">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="48MP">48 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="50MP" value="50">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="50MP">50 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="64MP" value="64">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="64MP">64 MP</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="main_camera" id="108MP" value="108">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="108MP">108 MP</label>
                        </div> --}}
                        @php($backCamera = explode(',', $phoneFinerCustomization->back_camera))
                        @foreach ($backCamera as $back_camera)
                            <div class="form-check p-0">
                                <input class="form-check-input d-none" type="radio" name="main_camera" id="{{ $back_camera }}MP" value="{{ $back_camera }}">
                                <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="{{ $back_camera }}MP">{{ $back_camera }} MP</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (@$phoneFinerCustomization->battery)
    <div class="container-fluid bg-light mb-md-2 pf-m">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="bg-light p-2 px-3">
                    <p class="fw-semibold finder-head">Battery</p>
                    <div class="d-grid battery-selection-grid">
                        {{-- <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="1000mAh" value="1000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="1000mAh">1000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="2000mAh" value="2000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="2000mAh">2000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="3000mAh" value="3000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="3000mAh">3000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="4000mAh" value="4000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="4000mAh">4000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="5000mAh" value="5000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="5000mAh">5000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="6000mAh" value="6000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="6000mAh">6000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="7000mAh" value="7000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="7000mAh">7000 mAh</label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input d-none" type="radio" name="battery" id="8000mAh" value="8000">
                            <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="8000mAh">8000 mAh</label>
                        </div> --}}
                        @php($batteries = explode(',', $phoneFinerCustomization->battery))
                        @foreach ($batteries as $battery)
                            <div class="form-check p-0">
                                <input class="form-check-input d-none" type="radio" name="battery" id="{{ $battery }}mAh" value="{{ $battery }}">
                                <label class="btn btn-radio fw-semibold w-100 form-placeholder" for="{{ $battery }}mAh">{{ $battery }} mAh</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container-fliud my-md-2 py-2 py-md-0 res_fix px-3">
        <div class="row justify-content-between">
            <div class="col-12 col-md-12 d-flex justify-content-end gap-2  mt-md-3 mb-md-4">
                <a href="{{ route('phone-finder') }}" class="btn btn-dark rounded-0 px-md-5 px-3 py-3 fw-bold  form-placeholder width-30">Reset All</a>
                <button type="submit" class="btn btn-custom rounded-0 px-md-5 px-3 py-3 fw-bold form-placeholder width-70">Apply Filter</button>
            </div>
        </div>
    </div>
</form>
<!-- </div> -->

@endsection


@section('script-js')
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

<link rel="stylesheet" href="{!! asset('assets/vendor/libs/select2/select2.css') !!}" />
<script src="{!! asset('assets/vendor/libs/select2/select2.js') !!}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // select2
        $(".select2").each(function() {
            $(this).select2({
                placeholder: $(this).data('placeholder')
            });
        });
    });
</script>
@endsection
