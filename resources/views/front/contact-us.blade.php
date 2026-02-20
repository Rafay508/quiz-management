@extends('front.layouts.app')
@section('title', @$seoData['title'] ?? 'Contact Us')

@section('content')
<div class="container-fliud my-4 margin overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="container pb-4 pt-2">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="row pb-4 pt-0 px-1">
                            <div class="col-12">
                                <form action="{{ route('contact.store') }}" method="POST" class="container contactForm">
                                    @csrf
                                    @method('POST')
                                    <div class="row justify-content-center">
                                        <div
                                            class="col-md-12 col-lg-8 col-12 text-center d-flex flex-column justify-content-center align-items-center">
                                            <h2 class='fw-bold'>Contact Us</h2>
                                            <p><small class='fw-semibold form-placeholder'>
                                                For a timely response to your question or concern, use the following contact information to find a point of contact or report an issue.
                                                </small>
                                            </p>
                                            <div class="text-danger font-sm">
                                                <span class='fs-5'>&#128712 </span>
                                                <small>
                                                    Note: Softliee doesn't sell any mobiles. Softliee provides mobile prices, specs and reviews only.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-md-6 col-lg-6 col-12  pe-md-4">
                                            <input type="text"
                                                class='form-control bg-light border-0 rounder-1 text-black fw-bold p-3 mt-3'
                                                name="first_name"
                                                required
                                                value="{{ old('first_name') }}"
                                                placeholder='First Name*'>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12  ps-md-4">
                                            <input type="text"
                                                class='form-control bg-light border-0 rounder-1 text-black fw-bold p-3 mt-3'
                                                name="last_name"
                                                required
                                                value="{{ old('last_name') }}"
                                                placeholder='Last Name*'>
                                        </div>
                                    </div>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-md-6 col-lg-6 col-12 pe-md-4">
                                            <input type="email"
                                                class='form-control bg-light border-0 rounder-1 text-black fw-bold p-3'
                                                name="email"
                                                required 
                                                value="{{ old('email') }}" 
                                                placeholder='Email Address*'>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 ps-md-4">
                                            <input type="text"
                                                class='form-control bg-light border-0 rounder-1 text-black fw-bold p-3 mt-3 mt-md-0'
                                                name="phone" 
                                                value="{{ old('phone') }}" 
                                                placeholder='Phone'>
                                        </div>
                                    </div>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-md-12 col-lg-12 col-12">
                                            <input type="text"
                                                class='form-control bg-light border-0 rounder-1 text-black fw-bold p-3'
                                                name="subject"
                                                required 
                                                value="{{ old('subject') }}" 
                                                placeholder='Subject*'>
                                        </div>
                                    </div>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-md-12 col-lg-12 col-12">
                                            <textarea
                                                class='form-control bg-light border-0 rounder-1 text-black-50 fw-bold p-3'
                                                name="message" placeholder="Message" rows="6">{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-md-12 col-lg-12 col-12 d-flex justify-content-end">
                                            <button type="button" class='btn btn-custom border-0 rounder-1 text-white fw-bold py-3 px-4 contactSubmitButton'>Submit Details</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-js')
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.contactSubmitButton').on('click', function(event){
            console.log(' clicked');
            event.preventDefault();
            toastr.success('Submitting Form , Please Wait');
            var form       = $('.contactForm')[0];
            var formData   = new FormData(form);
            var url        = $(form).attr('action');

            $.ajax({
                url     : url,
                type    : "POST",
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,  // Required for FormData
                contentType: false, 
                data    : formData ,
                success : function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        toastr.error(response.message); 
                    }
                },
                error: function() {
                    toastr.error('An error occurred while Submiting Details.');
                }
            });
        });
    });
</script>
@endsection