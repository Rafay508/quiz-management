@extends('front.auth.layouts.app')

<!-- Meta -->
@section('title', 'PixelProfile')
@section('description', 'Create stunning digital business cards with our easy-to-use platform. Customize your ecard with personal and professional information to make a lasting impression online.')
@section('keywords', 'Digital business cards, ecard creator, professional ecard design, personalized digital cards, online business card maker, virtual business cards, digital networking, customize ecards, digital contact information')
@section('image', asset('assets/img/logo.png'))

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-lg-flex col-lg-12">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center" style="background: url({!! asset('assets/img/illustrations/login.png') !!}); height: 98vh !important; margin: 5px; background-position: top; border-radius: 1.125rem;">
              <!-- <div class="authentication-inner py-4"> -->
                  <!-- Forgot Password -->
                  <div class="card" style="background: transparent !important;">
                    <div class="card-body">
                      <h4 class="mb-1 pt-2 text-white">Forgot Password? 🔒</h4>
                      <p class="mb-4 text-white">Enter your email and we'll send you instructions to reset your password</p>
                      <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="email" class="form-label text-white">Email</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            style="background: white !important;"
                            autofocus
                            required />
                        </div>
                        <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                      </form>
                      <div class="text-center">
                        <a href="{!! route('login') !!}" class="d-flex align-items-center justify-content-center">
                          <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                          Back to login
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- /Forgot Password -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
