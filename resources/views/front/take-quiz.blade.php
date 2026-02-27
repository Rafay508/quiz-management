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
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }

  .quiz-timer {
    font-size: 1rem;
    font-weight: bold;
  }

  .progress {
    height: 6px;
    margin-bottom: 15px;
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
      <h2>Advanced JavaScript Development</h2>
      <div class="quiz-timer">
        ⏱ Timer: 30:00
      </div>
    </div>

    <!-- Progress Bar -->
    <div class="mb-3">
      <small>Question 1 of 5</small>
      <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: 20%;"></div>
      </div>
    </div>

    <!-- Question Card -->
    <div class="card quiz-question">
      <div class="card-body">
        <h5>What is the correct syntax for a function in JavaScript?</h5>
        <div class="quiz-options mt-3">
          <label>
            <input type="radio" name="question1" value="1">
            function myFunction() {}
          </label>
          <label>
            <input type="radio" name="question1" value="2">
            function:myFunction() {}
          </label>
          <label>
            <input type="radio" name="question1" value="3">
            function = myFunction() {}
          </label>
          <label>
            <input type="radio" name="question1" value="4">
            func myFunction() {}
          </label>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="quiz-buttons">
      <button class="btn btn-secondary">Previous</button>
      <button class="btn btn-primary">Next</button>
      <button class="btn btn-success">Submit Quiz</button>
    </div>

  </div>
</section>
@endsection
