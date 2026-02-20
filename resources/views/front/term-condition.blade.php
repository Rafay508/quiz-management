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
                                {{ env('APP_NAME') . ' Terms & Conditions' }}
                            </h5>
                            <div class="container pt-4">
                                <div class="row g-md-4 g-2">
                                    @if(@$siteSettings && $siteSettings->privacy_policy != '')
                                        {!! $siteSettings->term_condition !!}
                                    @else
                                        -
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
