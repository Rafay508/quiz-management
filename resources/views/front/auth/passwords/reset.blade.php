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
                      <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-3 form-email-toggle">
                      <label class="form-label text-white" for="email">Email</label>
                      <div class="input-group input-group-merge">
                        <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                            style="background: white !important;"
                        autofocus
                        aria-describedby="email"
                        required />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-mail"></i></span>
                      </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label text-white" for="password">New Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="password"
                          class="form-control"
                            style="background: white !important;"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label text-white" for="confirm-password">Confirm Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="confirm-password"
                          class="form-control"
                          name="password_confirmation"
                            style="background: white !important;"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="confirm-password" required />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100 mb-3">Set new password</button>

                  </div>
                  <!-- .form-body-->
                </form>
                <!-- .form-login-->
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
