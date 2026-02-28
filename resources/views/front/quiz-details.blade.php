@extends('front.layouts.app')
@section('title', 'QuizMaster - Quiz Details')

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Quiz Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Quiz Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Quiz Details Section -->
    <section id="quiz-details" class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            
            <!-- Quiz Information Card -->
            <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body p-4">
                <h2 class="card-title mb-4">{{ ucfirst($quiz->title) }}</h2>
                <p class="card-text text-muted mb-4">
                  {{ ucfirst($quiz->description) }}
                </p>
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-clock-history me-2 text-primary fs-5"></i>
                      <div>
                        <strong>Duration:</strong>
                        <span class="text-muted ms-2">{{ $quiz->duration_minutes }} Minutes</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-question-circle me-2 text-primary fs-5"></i>
                      <div>
                        <strong>Total Questions:</strong>
                        <span class="text-muted ms-2">{{ $quiz->random_questions_count ?? $quiz->questions_count }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quiz Instructions Card -->
            <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="card-header bg-light">
                <h4 class="card-title mb-0">Quiz Instructions</h4>
              </div>
              <div class="card-body p-4">
                {{ ucfirst($quiz->instructions) }}
              </div>
            </div>

            <!-- Student Information Card -->
            <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="card-header bg-light">
                <h4 class="card-title mb-0">Student Information</h4>
              </div>
              <div class="card-body p-4">
                <form id="quizDetailsForm" action="{{ route('quiz.attempt', $quiz->id) }}" method="POST">
                  @csrf
                  
                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="fullName" class="form-label">
                        Full Name <span class="text-danger">*</span>
                      </label>
                      <input 
                        type="text" 
                        class="form-control" 
                        id="fullName" 
                        name="fullName" 
                        required
                        placeholder="Enter your full name"
                      >
                      <div class="invalid-feedback">
                        Please provide your full name.
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="email" class="form-label">
                        Email Address <span class="text-danger">*</span>
                      </label>
                      <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        required
                        placeholder="Enter your email address"
                      >
                      <div class="invalid-feedback">
                        Please provide a valid email address.
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="phone" class="form-label">
                        Phone Number <span class="text-danger">*</span>
                      </label>
                      <input 
                        type="text" 
                        class="form-control" 
                        id="phone" 
                        name="phone" 
                        required
                        placeholder="Enter your phone number"
                      >
                      <div class="invalid-feedback">
                        Please provide your phone number.
                      </div>
                    </div>
                  </div>

                  <div class="row mb-4">
                    <div class="col-12">
                      <label for="studentId" class="form-label">
                        Student ID <span class="text-danger">*</span>
                      </label>
                      <input 
                        type="text" 
                        class="form-control" 
                        id="studentId" 
                        name="studentId" 
                        required
                        placeholder="Enter your student ID"
                      >
                      <div class="invalid-feedback">
                        Please provide your student ID.
                      </div>
                    </div>
                  </div>

                  <!-- Agreement Checkbox -->
                  <div class="mb-4">
                    <div class="form-check">
                      <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="agreeInstructions" 
                        name="agreeInstructions"
                        required
                      >
                      <label class="form-check-label" for="agreeInstructions">
                        I have read and agree to the quiz instructions
                      </label>
                      <div class="invalid-feedback">
                        You must agree to the quiz instructions to proceed.
                      </div>
                    </div>
                  </div>

                  <!-- Start Quiz Button -->
                  <div class="d-grid">
                    <button 
                      type="submit" 
                      class="btn btn-primary btn-lg" 
                      id="startQuizBtn"
                    >
                      <i class="bi bi-play-circle me-2"></i>
                      Start Quiz
                    </button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section><!-- End Quiz Details Section -->
@endsection
