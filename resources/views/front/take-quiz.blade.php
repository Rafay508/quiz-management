@extends('front.layouts.app')
@section('title', 'QuizMaster - Take Quiz')

@section('css')
<style>
  .quiz-header {
    border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    padding-bottom: 15px;
    margin-bottom: 20px;
  }

  .quiz-question {
    margin-bottom: 20px;
  }

  .quiz-options label {
    display: block;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.2s;
  }

  .quiz-options input[type="radio"] {
    margin-right: 10px;
  }

  .quiz-options label:hover {
    background-color: #f8f9fa;
  }

  .quiz-buttons {
    text-align: right;
  }

  .quiz-timer {
    font-size: 1rem;
    font-weight: bold;
  }

  .progress {
    height: 6px;
    margin-bottom: 15px;
  }

  /*.result-modal .modal-body {
    padding: 2rem;
  }

  .result-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
  }

  .result-item:last-child {
    border-bottom: none;
  }

  .result-label {
    font-weight: 600;
    color: #495057;
  }

  .result-value {
    font-weight: 700;
    color: #212529;
  }

  .result-value.reward {
    color: #28a745;
    font-size: 1.2rem;
  }*/

  /* Header Gradient */
    .bg-gradient {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    /* Modal Animation */
    .result-modal {
        animation: scaleIn 0.3s ease-in-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Percentage Circle */
    .percentage-circle {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1cc88a, #17a673);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 600;
        color: white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Reward Badge */
    .reward-badge {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 20px;
        background: #f8f9fc;
        font-weight: 500;
        font-size: 14px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }

    /* Result Grid */
    .result-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .result-card {
        background: #f8f9fc;
        padding: 15px;
        border-radius: 12px;
        text-align: center;
        transition: 0.2s ease;
    }

    .result-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .result-card h6 {
        font-size: 18px;
        font-weight: 600;
        margin-top: 5px;
    }

    .full-width {
        grid-column: span 2;
    }

</style>
@endsection

@section('content')
<!-- Page Title -->
<div class="page-title light-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0">Take Quiz</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.html">Home</a></li>
        <li class="current">Take Quiz</li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- Quiz Section -->
<section id="take-quiz" class="section">
  <div class="container">

    <!-- Quiz Header -->
    <div class="quiz-header d-lg-flex justify-content-between align-items-center">
      <h2>{{ ucfirst($quiz->title) }}</h2>
      <div class="quiz-timer">
        ⏱ Timer: <span id="quiz-timer-display">{{ $quiz->duration_minutes }}:00</span>
      </div>
    </div>

    <form id="quiz-form" action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
      @csrf
      <!-- Question Card -->
      <div class="card quiz-question">
        @foreach ($questions as $key => $question)
        <div class="card-body">
          <h5><b>Question {{ $key+1 }}:</b> {{ ucfirst($question->question_text) }}</h5>
          <!-- Hidden input so unanswered question ID is also sent -->
          <input type="hidden" name="answers[{{ $question->id }}]" value="">

          <div class="quiz-options mt-3">
            @foreach ($question->options->shuffle() as $option)
            <label>
              <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                {{ ucfirst($option->option_text) }}
            </label>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>

      <!-- Navigation Buttons -->
      <div class="quiz-buttons">
        <button type="submit" id="submit-quiz-btn" class="btn btn-success">
          <span id="submit-btn-text">Submit Quiz</span>
          <span id="submit-btn-loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>
    </form>

  </div>
</section>

<!-- Quiz Results Modal -->
<div class="modal fade" id="quizResultModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content result-modal border-0 shadow-lg rounded-4 overflow-hidden">

      <!-- Header -->
      <div class="modal-header bg-gradient text-white text-center d-block py-4 border-0">
        <i class="bi bi-trophy-fill fs-2 mb-2 d-block"></i>
        <h5 class="modal-title fw-semibold mb-0">
          Quiz Completed Successfully!
        </h5>
      </div>

      <!-- Body -->
      <div class="modal-body px-4 py-4">

        <!-- Percentage Circle -->
        <div class="text-center mb-4">
          <div class="percentage-circle mx-auto mb-2">
            <span id="modal-percentage">0%</span>
          </div>

          <!-- Reward Badge -->
          <div id="modal-reward" class="reward-badge mt-2">
            Reward
          </div>

          <!-- Professional Reward Message -->
          <div class="reward-message mt-3">
            <p class="mb-1">
              🎉 <strong>Congratulations!</strong> You have successfully secured 
              <strong id="modal-percentage-text">0%</strong>.
            </p>

            <p class="mb-1">
              You have earned 
              <strong class="text-primary">
                PKR <span id="modal-score">0</span>
              </strong> as your reward.
            </p>
          </div>
        </div>

        <!-- Result Stats -->
        <div class="result-grid mt-4">

          <div class="result-card">
            <small>Total Questions</small>
            <h6 id="modal-total-questions">0</h6>
          </div>

          <div class="result-card">
            <small>Attempted</small>
            <h6 id="modal-attempted">0</h6>
          </div>

          <div class="result-card text-success">
            <small>Correct Answers</small>
            <h6 id="modal-correct">0</h6>
          </div>

          <div class="result-card text-danger">
            <small>Wrong Answers</small>
            <h6 id="modal-wrong">0</h6>
          </div>

        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer border-0 px-4 pb-4">
        <a href="{{ route('home') }}" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
          <i class="bi bi-house-door me-2"></i> Back to Home
        </a>
      </div>

    </div>
  </div>
</div>

<script>
(function() {
    // Wait for jQuery to be available
    function initTimer() {
        if (typeof jQuery === 'undefined') {
            setTimeout(initTimer, 100);
            return;
        }

        jQuery(document).ready(function($) {

            // Disable F5 / Ctrl+R refresh and common shortcuts
            $(document).on('keydown', function (e) {
                // F5 or Ctrl+R
                if (e.which === 116 || (e.ctrlKey && e.which === 82)) {
                    e.preventDefault();
                }

                // Ctrl+C, Ctrl+X, Ctrl+V (copy/cut/paste)
                if (e.ctrlKey && (e.which === 67 || e.which === 88 || e.which === 86)) {
                    e.preventDefault();
                }

                // Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U (DevTools view source)
                if (e.ctrlKey && e.shiftKey && (e.which === 73 || e.which === 74)) {
                    e.preventDefault();
                }

                if (e.ctrlKey && e.which === 85) { // Ctrl+U
                    e.preventDefault();
                }

                // Block Tab and Esc if needed
                if (e.key === "Tab" || e.key === "Escape") {
                    e.preventDefault();
                }
            });

            // Disable right click
            $(document).on('contextmenu', function (e) {
                e.preventDefault();
            });

            // Disable text selection / highlight
            $(document).on('selectstart dragstart', function (e) {
                e.preventDefault();
            });

            // Disable left click text drag
            $(document).on('mousedown', function(e) {
                if (e.button === 1) { // middle click
                    e.preventDefault();
                    alert('Page refresh is disabled during quiz!');
                }
            });

            // Disable cut
            document.addEventListener('cut', function (e) {
                e.preventDefault();
            });

            // Warn before window close / refresh with custom message
            window.addEventListener('beforeunload', function (e) {
                e.preventDefault();
                e.returnValue = 'Quiz is in progress! Please submit the quiz before leaving.';
                return 'Quiz is in progress! Please submit the quiz before leaving.';
            });

            // Timer configuration
            var endTime = new Date('{{ $endTime->toIso8601String() }}');
            var remainingSeconds = {{ $remainingSeconds }};
            var timerDisplay = $('#quiz-timer-display');
            var quizForm = $('#quiz-form');
            var submitBtn = $('#submit-quiz-btn');
            var submitBtnText = $('#submit-btn-text');
            var submitBtnLoader = $('#submit-btn-loader');
            var timerInterval;
            var isSubmitted = false;
            var isSubmitting = false;

            // Format seconds to MM:SS
            function formatTime(seconds) {
                var minutes = Math.floor(seconds / 60);
                var secs = seconds % 60;
                return minutes.toString().padStart(2, '0') + ':' + secs.toString().padStart(2, '0');
            }

            // Update timer display
            function updateTimer() {
                var now = new Date();
                var diff = Math.floor((endTime - now) / 1000);
                
                if (diff <= 0) {
                    // Time is up
                    timerDisplay.text('00:00');
                    timerDisplay.css('color', '#dc3545');
                    
                    if (!isSubmitted && !isSubmitting) {
                        clearInterval(timerInterval);
                        
                        // Show warning message
                        toastr.warning('Time is up! Your quiz will be submitted automatically.', 'Time Up!', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 3000
                        });
                        
                        // Auto-submit the form via AJAX
                        setTimeout(function() {
                            submitQuizForm();
                        }, 1000);
                    }
                    return;
                }

                // Update display
                timerDisplay.text(formatTime(diff));

                // Change color when time is running low (less than 1 minute)
                if (diff < 60) {
                    timerDisplay.css('color', '#dc3545'); // Red
                } else if (diff < 300) { // Less than 5 minutes
                    timerDisplay.css('color', '#ffc107'); // Yellow/Orange
                } else {
                    timerDisplay.css('color', ''); // Default color
                }
            }

            // Start the timer
            updateTimer(); // Initial update
            timerInterval = setInterval(updateTimer, 1000); // Update every second

            // AJAX Form Submission
            function submitQuizForm() {
                if (isSubmitted || isSubmitting) {
                    return;
                }

                isSubmitting = true;

                // Disable submit button and show loader
                submitBtn.prop('disabled', true);
                submitBtnText.addClass('d-none');
                submitBtnLoader.removeClass('d-none');

                // Get form data
                var formData = quizForm.serialize();
                var submitUrl = quizForm.attr('action');

                // Submit via AJAX
                $.ajax({
                    url: submitUrl,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        isSubmitted = true;
                        isSubmitting = false;
                        clearInterval(timerInterval);

                        if (response.status === 'success') {
                            // Show success message
                            toastr.success('Quiz submitted successfully!', 'Success!', {
                                "showMethod": "slideDown",
                                "hideMethod": "slideUp",
                                timeOut: 3000
                            });

                            // Populate modal with results
                            $('#modal-total-questions').text(response.data.total_questions);
                            $('#modal-attempted').text(response.data.attempted);
                            $('#modal-correct').text(response.data.correct);
                            $('#modal-wrong').text(response.data.wrong);
                            $('#modal-score').text(parseFloat(response.data.reward).toFixed(2));
                            $('#modal-percentage').text(response.data.percentage + '%');
                            $('#modal-percentage-text').text(response.data.percentage + '%');
                            $('#modal-reward').text('PKR ' + parseFloat(response.data.reward).toFixed(2));

                            // Show modal
                            var resultModal = new bootstrap.Modal(document.getElementById('quizResultModal'), {
                                backdrop: 'static',
                                keyboard: false
                            });
                            resultModal.show();

                            // blur background
                            $('.modal-backdrop').css({
                                '--bs-backdrop-bg': '#8d8a8a0f',  // custom background color
                                '--bs-backdrop-opacity': '1',      // full opacity
                                'backdrop-filter': 'blur(8px)',   // blur effect
                                '-webkit-backdrop-filter': 'blur(8px)' // Safari support
                            });
                        } else {
                            // Handle error response
                            toastr.error(response.message || 'An error occurred', 'Error!', {
                                "showMethod": "slideDown",
                                "hideMethod": "slideUp",
                                timeOut: 5000
                            });

                            // Re-enable submit button
                            submitBtn.prop('disabled', false);
                            submitBtnText.removeClass('d-none');
                            submitBtnLoader.addClass('d-none');
                        }
                    },
                    error: function(xhr) {
                        isSubmitted = false;
                        isSubmitting = false;
                        
                        // Re-enable submit button
                        submitBtn.prop('disabled', false);
                        submitBtnText.removeClass('d-none');
                        submitBtnLoader.addClass('d-none');

                        var errorMessage = 'An error occurred while submitting the quiz.';
                        var errors = {};

                        if (xhr.status === 422) {
                            // Validation errors
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errors = xhr.responseJSON.errors;
                                errorMessage = xhr.responseJSON.message || 'Validation failed';
                                
                                // Show individual validation errors
                                $.each(errors, function(key, value) {
                                    if (Array.isArray(value)) {
                                        value.forEach(function(msg) {
                                            toastr.error(msg, 'Validation Error!', {
                                                "showMethod": "slideDown",
                                                "hideMethod": "slideUp",
                                                timeOut: 5000
                                            });
                                        });
                                    } else {
                                        toastr.error(value, 'Validation Error!', {
                                            "showMethod": "slideDown",
                                            "hideMethod": "slideUp",
                                            timeOut: 5000
                                        });
                                    }
                                });
                            } else {
                                toastr.error(errorMessage, 'Validation Error!', {
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp",
                                    timeOut: 5000
                                });
                            }
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error. Please try again later.';
                            toastr.error(errorMessage, 'Server Error!', {
                                "showMethod": "slideDown",
                                "hideMethod": "slideUp",
                                timeOut: 5000
                            });
                        } else {
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            toastr.error(errorMessage, 'Error!', {
                                "showMethod": "slideDown",
                                "hideMethod": "slideUp",
                                timeOut: 5000
                            });
                        }
                    }
                });
            }

            // Handle form submission
            quizForm.on('submit', function(e) {
                e.preventDefault();
                
                var now = new Date();
                var diff = Math.floor((endTime - now) / 1000);
                
                if (diff <= 0 && !isSubmitted && !isSubmitting) {
                    clearInterval(timerInterval);
                    toastr.warning('Time is up! Your quiz will be submitted automatically.', 'Time Up!', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 3000
                    });
                    setTimeout(function() {
                        submitQuizForm();
                    }, 1000);
                    return false;
                }

                if (!isSubmitted && !isSubmitting) {
                    // Confirm submission
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You cannot change your answers after submission!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitQuizForm(); // Your existing function to submit the quiz
                        }
                    });
                }
                
                return false;
            });

            // Clean up on page unload
            $(window).on('beforeunload', function() {
                clearInterval(timerInterval);
            });
        });
    }

    // Start initialization
    initTimer();
})();
</script>
@endsection
