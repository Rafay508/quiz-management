@if (@$blog->comments && count($blog->comments) > 0)
    @foreach ($blog->comments as $key => $comment)
        <div class="col-12 mt-0 mb-2 flex column justify-content-end align-items start">
            <div class="row border-0 border-bottom justify-content-between">
                <div class="col-1">
                    <img src="{{ asset('assets/front/images/avatar.svg') }}" width='75'>
                </div>
                <div class="col-md-11 col-9">
                    <div class="row justify-content-between">
                        <div class="col-8">
                            <div class="d-flex flex-column g-0">
                                <h6 class="mb-1">{{ ucfirst(@$comment->user->name ?? '-') }}</h6>
                                <small
                                    class="text-muted font-sm">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @php
                            $hasLiked = @$comment->likes()->whereUserId(auth()->id())->exists();
                            $hasDisLiked = @$comment->dislikes()->whereUserId(auth()->id())->exists();
                        @endphp
                        <div class="col-4 d-flex justify-content-end ">
                            <div class="d-flex align-items-center gap-2 h-100">
                                <button class="btn border px-md-4 px-3 mr-2 rounded-0 font-thumb"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter{{ $key+1 }}">Reply</button>
                                <div class="d-flex align-items-center gap-2">
                                    <button
                                        class="btn border font-thumb btn-sm mr-2 d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                        data-type="comment_like" data-comment-id="{{ $comment->id }}" {{ @$hasLiked && $hasLiked ? 'disabled' : '' }}>
                                        <i class="fa fa-thumbs-up" style="color: {{ @$hasLiked && $hasLiked ? 'red' : '' }};"></i>
                                        <span class="ml-1">{{ null !== @$comment->toArray()['likes'] ? count($comment->toArray()['likes']) : '0' }}</span>
                                    </button>
                                    <button
                                        class="btn border btn-sm font-thumb d-flex flex-column justify-content-center align-items-center rounded-0 px-3 like_and_dislike_button"
                                        data-type="comment_dislike" data-comment-id="{{ $comment->id }}" {{ @$hasDisLiked && $hasDisLiked ? 'disabled' : '' }}>
                                        <i class="fa fa-thumbs-down" style="color: {{ @$hasDisLiked && $hasDisLiked ? 'red' : '' }};"></i>
                                        <span class="ml-1">{{ null !== @$comment->toArray()['dislikes'] ? count($comment->toArray()['dislikes']) : '0' }}</span>
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
                <div class="row mt-3 mb-0 flex column justify-content-end align-items start">
                    <div class="col-10">
                        <div class="row border-0 border-bottom d-flex gap-0 justify-content-between">
                            <div class="col-1">
                                <img src="{{ asset('assets/front/images/avatar.svg') }}" width='75'>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="row">
                                    <div class="col-md-12 col-8">
                                        <div class="d-flex flex-column g-0 ps-3">
                                            <h6 class="mb-1">{{ ucfirst(@$reply->user->name ?? '-') }}</h6>
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
        <div class="modal fade exampleModalCenter" id="exampleModalCenter{{ $key+1 }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reply to:
                            {{ ucfirst(@$comment->user->name ?? '-') }}</h5>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            X
                        </span>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control rounded-0 blog_comment_reply{{ $key+1 }}"
                            name="comment" placeholder="Write a reply...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary post_reply_button"
                            data-key="{{ $key+1 }}" data-comment-id="{{ $comment->id }}">Post Reply</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
