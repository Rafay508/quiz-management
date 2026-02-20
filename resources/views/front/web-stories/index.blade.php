@extends('front.layouts.app')

@section('title', @$seoData['title'] ?? 'Web Stories')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        function shareStory(event, url) {
            event.preventDefault();
            if (navigator.share) {
                navigator.share({
                    title: 'Web Story',
                    url: url
                }).catch(console.error);
            } else {
                alert('Sharing not supported on this browser.');
            }
        }
    </script>

    <style>
        .card {
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .card-body {
            padding: 12px;
            background: white;
            color: #181818;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-text {
            flex: 1;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .card-date {
            font-size: 11px;
            color: rgba(0, 0, 0, 0.5);
        }

        .share-icon {
            font-size: 1rem;
            color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
            margin-left: 12px;
        }

        .share-icon i {
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 50%;
            padding: 8px;
        }

        @media screen and (max-width: 768px) {
            .card img {
                height: 150px;
            }

            .card-title {
                font-size: 0.9rem;
            }

            .card-date {
                font-size: 10px;
            }

            .share-icon {
                font-size: 0.8rem;
            }

            .share-icon i {
                padding: 6px;
            }
        }
    </style>

    <div class="container-fluid mb-4 mt-5 mt-md-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container py-4">
                    <h5 class="fw-bold border-start border-danger border-4 px-2">Web Stories</h5>
                    <div class="row g-3 pt-4">
                        @if (@$web_story_categories && count($web_story_categories) > 0)
                            @foreach ($web_story_categories as $category)
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('web-story.detail', $category->slug) }}" class="text-decoration-none">
                                        <div class="card mb-0 pb-0">
                                            <img src="{{ asset('uploads/web-stories/' . $category->image) }}"
                                                alt="{{ $category->title }}">
                                            <div class="card-body">
                                                <div class="card-content">
                                                    <div class="card-text">
                                                        <h6 class="card-title fw-bolder">{{ ucfirst($category->title) }}</h6>
                                                        <p class="card-date fw-bold mb-0">
                                                            {{ date('M d, Y', strtotime($category->created_at)) }}
                                                        </p>
                                                    </div>
                                                    <span class="share-icon"
                                                        onclick="shareStory(event, '{{ route('web-story.detail', $category->slug) }}')">
                                                        <i class="fa-solid fa-share-nodes"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>Records not found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection