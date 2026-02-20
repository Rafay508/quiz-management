@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Default Title')

@section('content')
<div class="container my-5 margin">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-9">
            <div class="d-flex rounded-5 shadow sign overflow-hidden">
                <!-- Left Side: Image and Text -->
                <div class="sign-up-image col-md-6 d-none d-lg-flex flex-column align-items-center justify-content-start pt-5">
                    <!-- <h1 class="mt-5 text-custom fw-bolder fs-1">Sign In</h1> -->
                </div>
                
                <!-- Right Side: Form -->
                <div class="p-4 pb-3 col-lg-6 col-12">
                    <ul class="nav nav-pills mb-3 justify-content-lg-center justify-content-evenly gap-md-2 border-bottom pb-3 p-3" id="pills-tab" role="tablist">
                        <li class="nav-item " role="presentation">
                            <button class="nav-link active rounded-pill px-lg-5 px-4 fw-semibold fs-6 sign-btn" id="pills-signup-tab" data-bs-toggle="pill" data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup" aria-selected="true">Sign Up</button>
                        </li>
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <button class="nav-link rounded-pill px-lg-5 px-4 bg-light border-0 text-black-50 fw-semibold fs-6 sign-btn" id="pills-signup-tab" data-bs-toggle="pill" data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup" aria-selected="false" >Sign In</button></a>
                    </ul>

                    <form action="{{ route('register') }}" class='p-2 pb-0' method="POST">
                        @csrf
                        @method('POST')
                        <div class="name d-flex gap-1">
                            <div class="mb-3 w-50">
                                <label class="form-label fs-6 fw-semibold">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-2 border-0 bg-light fw-normal form-placeholder" id="fullname" placeholder="Full name..." style='height:43px;background-color:#F8F8F9;' required>
                            </div>
                            <div class="mb-3 w-50">
                                <label for="email" class="form-label fs-6 fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-2 border-0 bg-light fw-normal form-placeholder" id="email" placeholder="Email..." style='height:43px;background-color:#F8F8F9;' required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fs-6 fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control rounded-2 border-0 fw-normal form-placeholder" id="password" placeholder="Enter password..." style='height:43px;background-color:#F8F8F9;' required>
                        </div>
                        <div class="d-grid mt-md-0 mt-4">
                            <button type="submit" class="btn btn-custom rounded-pill fw-semibold fs-6 py-md-0 py-2"  style='height:39px;'>Sign Up</button>
                        </div>
                    </form>
                    <br>
                    <div class="row align-items-center">
                        <div class="col">
                            <hr class="text-muted" style="border-top: 1px solid #000;">
                        </div>
                        <div class="col-auto">
                            <span class="px-2 bg-white text-muted">Sign Up With:</span>
                        </div>
                        <div class="col">
                            <hr class="text-muted" style="border-top: 1px solid #000;">
                        </div>
                    </div>
            
                    <div class="d-flex flex-column justify-content-center mt-3 gap-3  p-2 pb-0">
                    <a href="{{ route('google.login') }}" class="btn rounded-pill w-100 bg-light border-0 p-2 text-black-50 fw-semibold  fs-6">
                            <i class="fa-brands fa-google"></i> 
                            Google
                        </a>
                    </div>
                    <div class="text-center text-muted pt-2  p-2 pb-0" style="font-size: 12px;">
                        A password can be set after you sign up if you prefer. Meanwhile, your information is secure and private.
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
