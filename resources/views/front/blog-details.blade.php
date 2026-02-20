@extends('front.layouts.app')
@section('content')

@section('header')
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

<!-- AMP Boilerplate Styles -->
<style amp-boilerplate>
    body {
        visibility: hidden;
    }
    @keyframes -amp-start {
        from { visibility: hidden; }
        to { visibility: visible; }
    }
</style>

<!-- AMP NoScript Styles for non-JavaScript users -->
<noscript>
    <style amp-boilerplate>
        body { visibility: visible; }
    </style>
</noscript>

<!-- AMP JS Script -->
<script async src="https://cdn.ampproject.org/v0.js"></script>
@endsection

@section('title', $blog->meta_title)
<div class="container my-md-4 mt-5 margin overflow-hidden" style='width:100vw'>
    <div class="row justify-content-center  px-0">
        <div class="col-md-12 col-lg-12">
            <div class="row g-1">
                <div class="col-12 d-flex align-items-center gap-1 d-none d-md-flex ms-3">
                    <p class="form-placeholder text-black-50 fw-semibold">Home
                        <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                    </p>
                    <p class="form-placeholder text-black-50 fw-semibold">Tech News
                        <img src="{{ asset('assets/front/images/productpage-nav-icon.svg') }}">
                    </p>
                    <p class="text-black-50 fw-semibold">
                        {{ ucfirst($blog->name) }}
                    </p>
                </div>
                <div class="container-fliud mb-4 mt-3">
                    @include('front.layouts.partials.head-ad')
                </div>
                <div class="col-md-9 col-12">
                    <div class="row px-3">
                        <div class="d-flex gap-2 flex-column d-none" style='width:75px;position:absolute;left: 50px;'>
                            <p class='text-black-50 bg-light social-font px-3 py-2'>
                                <i class="fa-brands fa-facebook-f"></i>
                            </p>
                            <p class='text-black-50 bg-light social-font px-3 py-2'>
                                <i class="fa-brands fa-youtube"></i>
                            </p>
                            <p class='text-black-50 bg-light social-font px-3 py-2'>
                                <i class="fa-brands fa-linkedin-in"></i>
                            </p>
                            <p class='text-black-50 bg-light social-font px-3 py-2'>
                                <i class="fa-brands fa-pinterest-p"></i>
                            </p>
                        </div>
                        <div class="col-12 mb-3">
                            @if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                                <img class="w-100"
                                    src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                    alt="{{ $blog->alt_image }}"
                                    layout="responsive">
                            @else
                                <img class="w-100"
                                    src="https://via.placeholder.com/600x200.png?text=No+Image"
                                    alt="placeholder image"
                                    layout="responsive">
                            @endif
                            @if ($blog->credit_by)
                                <p class="text-center"><b>Image Credit By:</b> {{ ucfirst($blog->credit_by) }}</p>
                            @endif
                            <h5 class='fw-bold px-2 border-start border-danger border-4 my-5 lh-base heading'>
                                {{ ucfirst($blog->name) }}
                            </h5>
                            <div class="d-flex flex-column gap-0">
                                {!! ucfirst($blog->description) !!}
                            </div>
                            <a href='https://play.google.com/store/apps/details?id=com.mobilestore.softliee'
                                class="d-flex justify-content-center align-items-center gap-4 shadow px-3 py-1 text-decoration-none text-dark"
                                target="_blank">
                                <img src="{{ asset('assets/front/images/playstoreicon.png') }}" alt=""
                                    width='50'>
                                <p class='fw-bold play-store mt-3'>
                                    Get the Softliee App now & scroll through your favourite content faster!
                                </p>
                            </a>
                            <div class="row bg-light mx-0 mt-5 mb-2 p-md-4 p-3 px-0">
                                <div class='w-aurthor'>
                                    @if (@$admin->image != '' && file_exists(uploadsDir('admin') . $admin->image))
                                        <img src="{!! asset(uploadsDir('admin') . $admin->image) !!}" class="w-100" alt="image" />
                                    @else
                                        <img src="{!! asset('assets/front/images/Aurthor.jpeg') !!}" class="w-100" alt="image" />
                                    @endif
                                </div>
                                <div class='w-80'>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <div class="w-70">
                                                <h5 class='fw-bold mb-1 pb-0'>{{ @$admin->first_name ?? 'Admin' }}</h5>
                                                <p class='mt-0 pt-0 mb-0 pb-0 text-black-50'>
                                                    <small class='fw-bold'>Published
                                                        {{ $blog->created_at->format('M d, Y') }}</small>
                                                </p>
                                                <p class='mt-0 pt-0 text-black-50'>
                                                    <small
                                                        class='fw-bold'>{{ $blog->created_at->format('h:i A') }}</small>
                                                </p>
                                            </div>
                                            <div class="w-50 d-md-flex justify-content-end gap-2 h-25 d-none">
                                                <div class="d-flex gap-2">
                                                    @php
                                                        $currentUrl = urlencode(url()->current());
                                                    @endphp
                                                    <a href="https://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                                                        target="_blank"
                                                        class='text-white bg-primary social-font px-3 py-2'>
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    </a>
                                                    <a href="https://pinterest.com/pin/create/button/?url={{ $currentUrl }}"
                                                        target="_blank"
                                                        class='text-white bg-danger social-font px-3 py-2'>
                                                        <i class="fa-brands fa-pinterest-p"></i>
                                                    </a>
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}"
                                                        target="_blank"
                                                        class='text-white bg-primary social-font px-3 py-2'>
                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                    </a>
                                                    <a href="{{ route('generate.sitemap-rss') }}"
                                                        target="_blank"
                                                        class='text-white bg-primary social-font px-3 py-2'>
                                                        <img style="width: 30px;" src="{{ asset('assets/front/images/rss-icon.svg') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-md-auto h-auto d-md-flex d-none">
                                            <div class='text-black d-flex gap-2 '><img
                                                    src="{{ asset('assets/front/images/Redo.png') }}" width='30'
                                                    height='25'>
                                                <p class='border-end border-1 border-black pe-3 '>
                                                    {{ $blog->clicks ?? '0' }} Views</p>
                                            </div>
                                            <div class='text-black d-flex gap-0'><img
                                                    src="{{ asset('assets/front/images/Comment.svg') }}" width='50'
                                                    height='25'>
                                                <p>{{ @$blog->comments ? count($blog->comments) : '0' }} Comments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-md-auto h-auto d-flex mt-2 mt-md-0 d-md-none">
                                    <div class='text-black d-flex gap-2 comment-icon-text'><img
                                            src="{{ asset('assets/front/images/Redo.png') }}" class='comment-icon'>
                                        <p class='border-end border-1 border-black pe-md-3 pe-2 fw-bold'>
                                            {{ $blog->clicks ?? '0' }} Views</p>
                                    </div>
                                    <div class='text-black d-flex gap-1  comment-icon-text'><img
                                            src="{{ asset('assets/front/images/ViewIcon.png') }}" class='comment-icon'>
                                        <p class='border-end border-1 border-black pe-md-3 pe-2 fw-bold'>
                                            {{ rand(1, 500) }} Shares</p>
                                    </div>
                                    <div class='text-black d-flex gap-0  comment-icon-text'><img
                                            src="{{ asset('assets/front/images/Comment.svg') }}" class='comment-icon'>
                                        <p class='fw-bold'>{{ @$blog->comments ? count($blog->comments) : '0' }}
                                            Comments</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex d-md-none">
                                <div class="w-100 d-flex d-md-none justify-content-end gap-2 h-25">
                                    <div class="d-flex gap-2">
                                        <a href="https://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                                            target="_blank" class='text-white bg-primary social-font px-2 py-1'>
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                        <a href="https://pinterest.com/pin/create/button/?url={{ $currentUrl }}"
                                            target="_blank" class='text-white bg-danger social-font px-2 py-1'>
                                            <i class="fa-brands fa-pinterest-p"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}"
                                            target="_blank" class='text-white bg-primary social-font px-2 py-1'>
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                        <a href="{{ route('generate.sitemap-rss') }}"
                                            target="_blank"
                                            class='text-white bg-primary social-font px-2 py-1'>
                                            <img style="width: 15px;" src="{{ asset('assets/front/images/rss-icon.svg') }}">
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 pt-4 flex-column justify-content-end align-items-start">
                                <div class="input-group">
                                    <img src="{{ asset('assets/front/images/avatar.svg') }}" width='50'>
                                    <input type="text" class="form-control rounded-0 blog_comment" name="comment"
                                        placeholder="Write a review...">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 mb-4 d-flex flex-row justify-content-end">
                                        <button type="button"
                                            class="btn btn-custom rounded-0 px-3 py-2 post_review_button fw-bold">Post
                                            Review</button>
                                    </div>
                                </div>
                            </div>
                            <div class="blog_comments_and_replies">
                                @if (@$blog->comments && count($blog->comments) > 0)
                                    @foreach ($blog->comments as $key => $comment)
                                        <div
                                            class="col-12 mt-0 mb-2 flex column justify-content-end align-items start">
                                            <div class="row border-0 border-bottom justify-content-between">
                                                <div class="col-1">
                                                    <img src="{{ asset('assets/front/images/avatar.svg') }}"
                                                        width='75'>
                                                </div>
                                                <div class="col-md-11 col-9">
                                                    <div class="row justify-content-between">
                                                        <div class="col-8">
                                                            <div class="d-flex flex-column g-0">
                                                                <h6 class="mb-1">
                                                                    {{ ucfirst(@$comment->user->name ?? '-') }}</h6>
                                                                <small
                                                                    class="text-muted font-sm">{{ $comment->created_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $hasLiked = @$comment
                                                                ->likes()
                                                                ->whereUserId(auth()->id())
                                                                ->exists();
                                                            $hasDisLiked = @$comment
                                                                ->dislikes()
                                                                ->whereUserId(auth()->id())
                                                                ->exists();
                                                        @endphp
                                                        <div class="col-4 d-flex justify-content-end ">
                                                            <div class="d-flex align-items-center gap-2 h-100">
                                                                <button
                                                                    class="btn border px-md-4 px-3 mr-2 rounded-0 font-thumb"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalCenter{{ $key + 1 }}">Reply</button>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <button
                                                                        class="btn border font-thumb btn-sm mr-2 d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                                                        data-type="comment_like"
                                                                        data-comment-id="{{ $comment->id }}"
                                                                        {{ @$hasLiked && $hasLiked ? 'disabled' : '' }}>
                                                                        <i class="fa fa-thumbs-up"
                                                                            style="color: {{ @$hasLiked && $hasLiked ? 'red' : '' }};"></i>
                                                                        <span
                                                                            class="ml-1">{{ null !== @$comment->toArray()['likes'] ? count($comment->toArray()['likes']) : '0' }}</span>
                                                                    </button>
                                                                    <button
                                                                        class="btn border btn-sm font-thumb d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                                                        data-type="comment_dislike"
                                                                        data-comment-id="{{ $comment->id }}"
                                                                        {{ @$hasDisLiked && $hasDisLiked ? 'disabled' : '' }}>
                                                                        <i class="fa fa-thumbs-down"
                                                                            style="color: {{ @$hasDisLiked && $hasDisLiked ? 'red' : '' }};"></i>
                                                                        <span
                                                                            class="ml-1">{{ null !== @$comment->toArray()['dislikes'] ? count($comment->toArray()['dislikes']) : '0' }}</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-1 mb-0 pb-0">
                                                        <div class="col-12 pb-0">
                                                            <p class='form-placeholder'>
                                                                {{ ucfirst(@$comment->comment) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- reply -->
                                        @if (@$comment->replies && count($comment->replies) > 0)
                                            @foreach ($comment->replies as $reply)
                                                <div
                                                    class="row mt-3 mb-0 flex column justify-content-end align-items start">
                                                    <div class="col-10">
                                                        <div
                                                            class="row border-0 border-bottom d-flex gap-0 justify-content-between">
                                                            <div class="col-1">
                                                                <img src="{{ asset('assets/front/images/avatar.svg') }}"
                                                                    width='75'>
                                                            </div>
                                                            <div class="col-md-11 col-9">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-8">
                                                                        <div class="d-flex flex-column g-0 ps-3">
                                                                            <h6 class="mb-1">
                                                                                {{ ucfirst(@$reply->user->name ?? '-') }}
                                                                            </h6>
                                                                            <small
                                                                                class="text-muted font-sm">{{ $reply->created_at->diffForHumans() }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-1 mb-0 pb-0">
                                                                    <div class="col-12 pb-0 ps-4">
                                                                        <p class='form-placeholder'>
                                                                            {{ ucfirst(@$reply->comment) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <!-- Reply Modal -->
                                        <div class="modal fade exampleModalCenter"
                                            id="exampleModalCenter{{ $key + 1 }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Reply to:
                                                            {{ ucfirst(@$comment->user->name ?? '-') }}</h5>
                                                        <span type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            X
                                                        </span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text"
                                                            class="form-control rounded-0 blog_comment_reply{{ $key + 1 }}"
                                                            name="comment" placeholder="Write a reply...">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button"
                                                            class="btn btn-primary post_reply_button"
                                                            data-key="{{ $key + 1 }}"
                                                            data-comment-id="{{ $comment->id }}">Post Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- end comments -->
                        </div>
                    </div>
                    @if (@$blog_gallery && count($blog_gallery) > 0)
                        <div class="row g-md-4 g-2">
                            @foreach($blog_gallery as $gallery)
                                <div class="col-md-3 col-6 d-flex flex-row gap-3">
                                    <div class='text-decoration-none w-100'>
                                        <div class="rounded-0 py-2">
                                        @if ($gallery->image && file_exists(public_path('uploads/blogs/' . $gallery->image)))
                                            <img class="card-img-top px-md-3 px-lg-2 px-1 py-2 prod-img"
                                                src="{{ asset('uploads/blogs/' . $gallery->image) }}"
                                                alt="Blog Gallery Image">
                                        @else
                                            <img class="card-img-top px-md-3 px-lg-2 px-1 py-2 prod-img"
                                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                alt="placeholder image">
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="d-md-flex d-none align-items-baseline justify-content-between">
                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 fs-6'>Tech News</h5>
                        <a href="#" class='text-danger d-flex align-items-none form-placeholder text-decoration-none'>
                            <p class='fw-bold'>See More</p>
                        </a>
                    </div>

                    <div class="row ms-1 d-none d-md-flex">
                        <div class="col-12">
                            @if (@$blogs && count($blogs) > 0)
                                @foreach ($blogs as $related_blog)
                                    <div class="card mb-2 w-100 rounded-0 p-2 card-shadow">
                                        <div class="row g-0 align-items-center py-3">
                                            <div class="col-md-5 col-5">
                                                @if ($related_blog->image && file_exists(public_path('uploads/blogs/' . $related_blog->image)))
                                                    <img class="img-fluid"
                                                        src="{{ asset('uploads/blogs/' . $related_blog->image) }}"
                                                        alt="{{ $related_blog->alt_image }}">
                                                @else
                                                    <img class="img-fluid"
                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                        alt="placeholder image">
                                                @endif
                                            </div>
                                            <div class="col-md-7 col-7">
                                                <div class="card-body py-0 my-0 me-0 pe-0">
                                                    <p class="card-text form-placeholder fw-semibold">
                                                        <a href="{{ route('blog-details', $related_blog->slug) }}"
                                                            class="text-decoration-none text-dark fw-semibold">
                                                            {{ Str::limit($related_blog->name, '40', '...') }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class=" d-none d-md-flex align-items-baseline justify-content-between mt-3">
                        <h5 class='fw-bold px-2 pt-1 border-start border-danger border-4 mx-3 fs-6'>More Mobiles</h5>
                        <a href="#" class='text-danger d-flex align-items-none form-placeholder text-decoration-none'>
                            <p class='fw-bold'>See More</p>
                        </a>
                    </div>
                    <div class="row ms-1 d-md-block d-none">
                        <div class="col-12">
                            @if (@$products && count($products) > 0)
                                @foreach ($products->take(4) as $product)
                                    <div class="card mb-2 w-100 rounded-0 p-2 px-3 card-shadow">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4">
                                                @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                    <img class="img-fluid"
                                                        src="{{ asset('uploads/products/' . $product->image) }}"
                                                        alt="{{ $product->alt_image }}">
                                                @else
                                                    <img class="img-fluid"
                                                        src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                        alt="placeholder image">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body py-0 my-0 d-flex flex-column gap-1">
                                                    <p class="card-text form-placeholder  py-0 my-0 fw-semibold">
                                                        {{ ucfirst($product->name) }}
                                                    </p>
                                                    <p class="card-text fs-6 py-0 my-0 fw-semibold text-black-50">
                                                        {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                    </p>
                                                    <a href="{{ route('product.details', $product->slug) }}"
                                                        class='text-decoration-none'>
                                                        <small class="text-danger fw-bold text-decoration-underline"
                                                            style="position:relative;top: -4px;">
                                                            Read More
                                                        </small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="d-md-flex align-items-baseline justify-content-between mt-3 d-none">
                        <h5 class='fw-bold px-2 py-1 border-start border-danger border-4 mx-3    fs-6'>Browse By Budget
                        </h5>
                    </div>
                    <div class="row g-md-1 g-3  ms-2 me-0 pe-0 flex-md-row d-none d-md-flex"
                        style='position:relative; left:5px;'>
                        <div class="col-6 mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 10000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 10,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 15000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 15,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 25000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 25,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 35000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 35,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 45000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 45,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 65000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 65,000
                                </div>
                            </a>
                        </div>
                        <div class="col-6  mb-1">
                            <a href="{{ route('filter-mobile', ['budget' => 85000]) }}" class='text-decoration-none'>
                                <div class="btn btn-light fw-bolder w-100 card-shadow form-placeholder rounded-1">
                                    Under 85,000
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row me-0 pe-0">
                        <div class="col-12 d-none d-md-block mt-5">
                            <div class="row">
                                <div class="col-12 mx-3">
                                    <!-- Desktop Header Ad -->
                                    <div class="font-sm text-center text-black-50 fw-semibold mb-0 w-100">Advertisement
                                    </div>

                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2933454440337038"
                                        crossorigin="anonymous"></script>

                                    <!-- horizental ads -->
                                    <ins class="adsbygoogle bg-light"
                                        style="display:inline-block;width:100%;height:500px"
                                        data-ad-client="ca-pub-2933454440337038" data-ad-slot="2568091697"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (@$products && count($products) > 0)
                {{-- <div class="container-fliud py-md-4 pt-5 px-md-3">
                    <div class="row justify-content-center   pe-2">
                        <div class="col-md-12 col-lg-12">
                            <div class="row py-4 px-md-1 px-2">
                                <h5 class='fw-bold pt-1 border-start border-danger border-4  heading'>Popular Mobile
                                    For You
                                </h5>
                                <div class="container py-md-4 pt-5 px-0 mx-0">
                                    <div class="row g-md-1 g-1 px-0 mx-0 pe-2 pe-md-0">
                                        @foreach ($products->take(4) as $product)
                                            <div class="col-md-3 col-6 d-flex flex-row gap-3  mb-2 mb-md-0">
                                                <a href="{{ route('product.details', $product->slug) }}"
                                                    class='text-decoration-none'>
                                                    <div
                                                        class="card rounded-0 pt-2 px-md-2 px-lg-0 px-xl-1 border-secondary border-opacity-25 card-shadow">
                                                        @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                                src="{{ asset('uploads/products/' . $product->image) }}"
                                                                alt="{{ $product->alt_image }}">
                                                        @else
                                                            <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                                src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                alt="placeholder image">
                                                        @endif

                                                        <div class="card-body text-center">
                                                            @if (@$product->galleries && count($product->galleries) > 0)
                                                                <p
                                                                    class="card-text text-black-50 vertical-card fw-bold text-decoration-underline mb-2">
                                                                    View Photos({{ count($product->galleries) }})
                                                                </p>
                                                            @endif
                                                            <h6
                                                                class="card-text fw-bolder text-black form-placeholder">
                                                                {{ ucfirst($product->name) }}
                                                            </h6>
                                                            <p class="card-text fw-bold form-placeholder"
                                                                style='color: #737373;'>
                                                                {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                            </p>
                                                            <a href="{{ route('compare-page', ['from' => $product->slug]) }}"
                                                                class="btn btn-custom rounded-1 form-placeholder px-md-3 px-2 fw-semibold">
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
                </div> --}}
                <div class="container py-md-4 pt-5 px-md-3 overflow-hidden" style="width:100vw">
                    <div class="row justify-content-center  pe-2">
                        <div class="col-md-12 col-lg-12">
                            <div class="container-fliud pt-md-4 py-4 px-md-0">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row pt-md-4 py-4 px-md-0 px-2">
                                            <h5 class='fw-bold pt-1 border-start border-danger border-4  heading'>Popular Mobile
                                                For You
                                            </h5>
                                            <div class="container pt-4 px-0 mx-0 pe-2 pe-md-0">
                                                <div class="row g-md-1 g-2 px-0 mx-0">
                                                    @foreach ($products->take(4) as $product)
                                                        <div class="col-md-3 col-6 d-flex flex-row gap-3 mb-2 mb-md-0">
                                                            <a href="{{ route('product.details', $product->slug) }}"
                                                                class='text-decoration-none'>
                                                                <div
                                                                    class="card w-100 rounded-0 pt-md-2 px-md-2 px-lg-0 px-xl-1 border-secondary border-opacity-25 card-shadow">
                                                                    @if ($product->image && file_exists(public_path('uploads/products/' . $product->image)))
                                                                    <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2 position-relative" style="width: 100%;height:200px;  object-fit: contain;"
                                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                                            alt="{{ $product->alt_image }}">
                                                                    @else
                                                                    <img class="card-img-top px-md-5 px-lg-4 px-3 pt-2"
                                                                    src="https://via.placeholder.com/300x100.png?text=No+Image"
                                                                            alt="placeholder image" style="width: 90%;  object-fit: contain;">
                                                                    @endif

                                                                    <div class="card-body text-center">
                                                                        @if ($product->galleries && count($product->galleries) > 0)
                                                                            <p
                                                                                class="card-text text-black-50 vertical-card fw-bold text-decoration-underline mb-2">
                                                                                View Photos({{ count($product->galleries) }})
                                                                            </p>
                                                                        @endif
                                                                        <h6
                                                                            class="card-text fw-bolder text-black form-placeholder">
                                                                            {{ ucfirst($product->name) }}
                                                                        </h6>
                                                                        <p class="card-text fw-bold form-placeholder"
                                                                            style='color: #737373;'>
                                                                            {!! env('CURRENCY', 'PKR') . ' ' . number_format($product->original_price) !!}
                                                                        </p>
                                                                        <a href="{{ route('compare-page', ['from' => $product->slug]) }}"
                                                                            class="btn btn-custom rounded-1 h6 px-md-3 px-1 fw-semibold">
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
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script-js')
<script type="text/javascript">
    // post blog reviews
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    function postReview(data) {
        // processing ajax request    
        $.ajax({
            url: "{{ route('blog.post-comment') }}",
            type: 'POST',
            dataType: "json",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.status == 1) {
                    $(".blog_comment").val('');

                    if ($('.exampleModalCenter').hasClass('show')) { // Check if the modal is open
                        $('.exampleModalCenter').modal('hide'); // Close the modal
                    }

                    $('.blog_comments_and_replies').html('');
                    $('.blog_comments_and_replies').html(data.blog_comments_and_replies);

                    toastr.success(data.message, 'Success!', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                } else if (data.status == 0) {
                    toastr.error(data.message, 'Error!', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                } else if (data.status == 2) {
                    toastr.info(data.message, 'Info!', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });

                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                } else {
                    toastr.error("Something went wrong please try again later.", 'Error!', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                }
            }
        });
    }

    // comment
    $('.post_review_button').on('click', function() {
        var data = {
            blog_id: "{{ $blog->id }}",
            comment: $(".blog_comment").val(),
            type: 'comment'
        };

        // Call the postReview function
        postReview(data);
    });

    // reply
    $(document).on('click', '.post_reply_button', function() {
        var key = $(this).data('key');
        var commentId = $(this).data('comment-id');
        var data = {
            blog_id: "{{ $blog->id }}",
            blog_comment_id: commentId,
            comment: $(".blog_comment_reply" + key).val(),
            type: 'reply'
        };

        // Call the postReview function
        postReview(data);
    });

    // like & dislike
    $(document).on('click', '.like_and_dislike_button', function() {
        var type = $(this).data('type');
        var commentId = $(this).data('comment-id');
        var data = {
            blog_id: "{{ $blog->id }}",
            blog_comment_id: commentId,
            type: type
        };

        // Call the postReview function
        postReview(data);
    });
</script>
@endsection
