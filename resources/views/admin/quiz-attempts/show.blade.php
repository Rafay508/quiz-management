@extends('admin.layouts.app')

@section('title', 'Quiz Attempt Details')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Quiz Attempt Details</h5>
                            <a href="{{ route('admin.quiz-attempts.index') }}" class="btn btn-label-secondary">
                                <i class="ti ti-arrow-left ti-sm me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">User Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name:</label>
                                    <p class="mb-0">{{ $quizAttempt->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email:</label>
                                    <p class="mb-0">{{ $quizAttempt->email ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Phone:</label>
                                    <p class="mb-0">{{ $quizAttempt->phone ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Student ID:</label>
                                    <p class="mb-0">{{ $quizAttempt->student_id ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">IP Address:</label>
                                    <p class="mb-0">{{ $quizAttempt->ip_address ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">User Agent:</label>
                                    <p class="mb-0 text-truncate" style="max-width: 400px;" title="{{ $quizAttempt->user_agent ?? 'N/A' }}">
                                        {{ $quizAttempt->user_agent ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Start Time:</label>
                                    <p class="mb-0">{{ $quizAttempt->start_time ? $quizAttempt->start_time->format('Y-m-d H:i:s') : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">End Time:</label>
                                    <p class="mb-0">{{ $quizAttempt->end_time ? $quizAttempt->end_time->format('Y-m-d H:i:s') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quiz Results Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quiz Results</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $attemptedQuestions = $quizAttempt->userAnswers->count();
                                $correctAnswers = $quizAttempt->userAnswers->where('is_correct', true)->count();
                                $wrongAnswers = $quizAttempt->userAnswers->where('is_correct', false)->count();
                            @endphp
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Quiz Title:</label>
                                    <p class="mb-0">{{ $quizAttempt->quiz->title ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Status:</label>
                                    <p class="mb-0">
                                        @if($quizAttempt->status == 'completed')
                                            <span class="badge bg-label-success">Completed</span>
                                        @elseif($quizAttempt->status == 'in_progress')
                                            <span class="badge bg-label-warning">In Progress</span>
                                        @else
                                            <span class="badge bg-label-danger">Abandoned</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Total Marks:</label>
                                    <p class="mb-0">{{ $quizAttempt->total_marks ?? '0' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Obtained Marks:</label>
                                    <p class="mb-0">{{ $quizAttempt->score ?? '0' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Total Questions:</label>
                                    <p class="mb-0">{{ $quizAttempt->total_questions ?? '0' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Attempted Questions:</label>
                                    <p class="mb-0">
                                        <span class="badge bg-label-info">{{ $attemptedQuestions }}</span>
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Correct Answers:</label>
                                    <p class="mb-0">
                                        <span class="badge bg-label-success">{{ $correctAnswers }}</span>
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Wrong Answers:</label>
                                    <p class="mb-0">
                                        <span class="badge bg-label-danger">{{ $wrongAnswers }}</span>
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Percentage:</label>
                                    <p class="mb-0">{{ $quizAttempt->percentage ? number_format($quizAttempt->percentage, 2) . '%' : '0%' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Pass/Fail:</label>
                                    <p class="mb-0">
                                        @if($quizAttempt->status == 'completed')
                                            @if($quizAttempt->is_passed)
                                                <span class="badge bg-label-success">Pass</span>
                                            @else
                                                <span class="badge bg-label-danger">Fail</span>
                                            @endif
                                        @else
                                            <span class="badge bg-label-secondary">N/A</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Wise Breakdown Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Question Wise Breakdown</h5>
                        </div>
                        <div class="card-body">
                            @forelse($quizAttempt->userAnswers as $index => $userAnswer)
                                @php
                                    $question = $userAnswer->question;
                                    $correctOption = $question->options->where('is_correct', true)->first();
                                @endphp

                                <div class="card mb-4 border {{ $userAnswer->is_correct ? 'border-success' : 'border-danger' }}">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Question {{ $index + 1 }}</h6>
                                            <div>
                                                @if($userAnswer->is_correct)
                                                    <span class="badge bg-label-success">Correct</span>
                                                @else
                                                    <span class="badge bg-label-danger">Incorrect</span>
                                                @endif
                                                <span class="badge bg-label-info ms-2">Marks: {{ $userAnswer->marks_obtained ?? '0' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="fw-bold mb-3">{{ $question->question_text }}</p>
                                        
                                        @if($question->image_url)
                                            <div class="mb-3">
                                                <img src="{{ asset($question->image_url) }}" alt="Question Image" class="img-fluid" style="max-height: 300px;">
                                            </div>
                                        @endif

                                        <div class="options-list">
                                            @foreach($question->options as $option)
                                                @php
                                                    $isCorrect = $option->is_correct;
                                                    $isSelected = $userAnswer->selected_option_id == $option->id;
                                                    $isWrongSelection = $isSelected && !$isCorrect;
                                                @endphp

                                                <div class="form-check mb-2 p-2 rounded {{ $isCorrect ? 'bg-light-success' : ($isWrongSelection ? 'bg-light-danger' : 'bg-light') }}">
                                                    <input class="form-check-input" type="radio" disabled {{ $isSelected ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100">
                                                        <span class="{{ $isCorrect ? 'text-success fw-bold' : ($isWrongSelection ? 'text-danger fw-bold' : '') }}">
                                                            {{ $option->option_text }}
                                                            @if($isCorrect)
                                                                <i class="ti ti-check ti-sm ms-1"></i> (Correct Answer)
                                                            @endif
                                                            @if($isSelected && !$isCorrect)
                                                                <i class="ti ti-x ti-sm ms-1"></i> (Your Answer)
                                                            @endif
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($question->explanation)
                                            <div class="alert alert-info mt-3 mb-0">
                                                <strong>Explanation:</strong> {{ $question->explanation }}
                                            </div>
                                        @endif

                                        @if($userAnswer->answer_text)
                                            <div class="alert alert-secondary mt-3 mb-0">
                                                <strong>Text Answer:</strong> {{ $userAnswer->answer_text }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    No questions attempted for this quiz.
                                </div>
                            @endforelse
                        </div>
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

@section('css')
<style>
    .bg-light-success {
        background-color: #d1f2eb !important;
    }
    .bg-light-danger {
        background-color: #fadbd8 !important;
    }
</style>
@endsection
