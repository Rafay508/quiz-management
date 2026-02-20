@extends('admin.layouts.app')

@section('content')

<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                {{-- <!-- Website Analytics -->
                <div class="col-lg-6 mb-4">
                    <div
                        class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                        id="swiper-with-pagination-cards">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-white mb-0 mt-2">Website Analytics</h5>
                                        <small>Total 28.5% Conversion Rate</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                            <h6 class="text-white mt-0 mt-md-3 mb-3">Traffic</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">28%</p>
                                                            <p class="mb-0">Sessions</p>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k</p>
                                                            <p class="mb-0">Leads</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">3.1k</p>
                                                            <p class="mb-0">Page Views</p>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
                                                            <p class="mb-0">Conversions</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                            <img
                                                src="../assets/img/illustrations/card-website-analytics-1.png"
                                                alt="Website Analytics"
                                                width="170"
                                                class="card-website-analytics-img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div> --}}
                <!--/ Website Analytics -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-users ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ @$adminCount }}</h5>
                            <small>Administrators</small>
                        </div>
                        <div id="revenueGeneratedAdmins"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-book ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ @$userCount }}</h5>
                            <small>Users</small>
                        </div>
                        <div id="revenueGeneratedUsers"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-package ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ @$productCount }}</h5>
                            <small>Products</small>
                        </div>
                        <div id="revenueGeneratedProducts"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-credit-card ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ @$blogCount }}</h5>
                            <small>Blogs</small>
                        </div>
                        <div id="revenueGeneratedBlogs"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        @include('admin.layouts.partials.footer')
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>
@endsection