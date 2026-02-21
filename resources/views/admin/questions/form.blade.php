@extends('admin.layouts.app')

@section('title', isset($question) ? 'Edit Question' : 'Add Question')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ isset($question) ? 'Edit Question' : 'Add Question' }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ isset($question) ? route('admin.questions.update', $question->id) : route('admin.questions.store') }}" id="questionForm" class="number-tab-steps wizard-circle">
                                @csrf
                                @if(isset($question))
                                    @method('PUT')
                                @endif

                                <!-- Step Indicator -->
                                <ul class="nav nav-pills nav-justified mb-4" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab">
                                            <span class="step-number">1</span>
                                            <span class="step-title">Question Details</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab">
                                            <span class="step-number">2</span>
                                            <span class="step-title">MCQ Options</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab">
                                            <span class="step-number">3</span>
                                            <span class="step-title">Quiz Assignment</span>
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Step 1: Question Details -->
                                    <div class="tab-pane fade show active" id="step1" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label" for="question_text">Question Text *</label>
                                            <textarea
                                                class="form-control @error('question_text') is-invalid @enderror"
                                                id="question_text"
                                                name="question_text"
                                                rows="5"
                                                required>{{ old('question_text', $question->question_text ?? '') }}</textarea>
                                            @error('question_text')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="marks">Marks *</label>
                                                <input
                                                    type="number"
                                                    class="form-control @error('marks') is-invalid @enderror"
                                                    id="marks"
                                                    name="marks"
                                                    value="{{ old('marks', $question->marks ?? '') }}"
                                                    min="0"
                                                    required />
                                                @error('marks')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label" for="difficulty_level">Difficulty Level</label>
                                                <select id="difficulty_level" name="difficulty_level" class="form-select @error('difficulty_level') is-invalid @enderror">
                                                    <option value="">Select Difficulty</option>
                                                    <option value="easy" {{ old('difficulty_level', $question->difficulty_level ?? '') == 'easy' ? 'selected' : '' }}>Easy</option>
                                                    <option value="medium" {{ old('difficulty_level', $question->difficulty_level ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="hard" {{ old('difficulty_level', $question->difficulty_level ?? '') == 'hard' ? 'selected' : '' }}>Hard</option>
                                                </select>
                                                @error('difficulty_level')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="explanation">Explanation</label>
                                            <textarea
                                                class="form-control @error('explanation') is-invalid @enderror"
                                                id="explanation"
                                                name="explanation"
                                                rows="3">{{ old('explanation', $question->explanation ?? '') }}</textarea>
                                            @error('explanation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next: MCQ Options</button>
                                        </div>
                                    </div>

                                    <!-- Step 2: MCQ Options -->
                                    <div class="tab-pane fade" id="step2" role="tabpanel">
                                        <div id="optionsContainer">
                                            @if(isset($question) && $question->options->count() > 0)
                                                @php
                                                    $correctOptionIndex = null;
                                                    foreach($question->options as $idx => $opt) {
                                                        if ($opt->is_correct) {
                                                            $correctOptionIndex = $idx;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                @foreach($question->options as $index => $option)
                                                    <div class="option-row mb-3 border p-3 rounded" data-index="{{ $index }}">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="mb-0">Option {{ $index + 1 }}</h6>
                                                            @if($index >= 2)
                                                                <button type="button" class="btn btn-sm btn-label-danger" onclick="removeOption({{ $index }})">Remove</button>
                                                            @endif
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Option Text *</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="options[{{ $index }}][text]"
                                                                value="{{ $option->option_text }}"
                                                                required />
                                                        </div>
                                                        <div>
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input correct-option-radio"
                                                                    type="radio"
                                                                    name="correct_option"
                                                                    value="{{ $index }}"
                                                                    id="correct{{ $index }}"
                                                                    {{ $correctOptionIndex == $index ? 'checked' : '' }} />
                                                                <label class="form-check-label" for="correct{{ $index }}">
                                                                    Correct Answer
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @for($i = 0; $i < 4; $i++)
                                                    <div class="option-row mb-3 border p-3 rounded" data-index="{{ $i }}">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="mb-0">Option {{ $i + 1 }}</h6>
                                                            @if($i >= 2)
                                                                <button type="button" class="btn btn-sm btn-label-danger" onclick="removeOption({{ $i }})">Remove</button>
                                                            @endif
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Option Text *</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="options[{{ $i }}][text]"
                                                                value="{{ old('options.' . $i . '.text', '') }}"
                                                                {{ $i < 2 ? 'required' : '' }} />
                                                        </div>
                                                        <div>
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input correct-option-radio"
                                                                    type="radio"
                                                                    name="correct_option"
                                                                    value="{{ $i }}"
                                                                    id="correct{{ $i }}"
                                                                    {{ old('correct_option') == $i ? 'checked' : '' }} />
                                                                <label class="form-check-label" for="correct{{ $i }}">
                                                                    Correct Answer
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <button type="button" class="btn btn-label-secondary" onclick="addOption()">
                                                <i class="ti ti-plus me-1"></i> Add More Options
                                            </button>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-label-secondary" onclick="prevStep(1)">Previous</button>
                                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next: Quiz Assignment</button>
                                        </div>
                                    </div>

                                    <!-- Step 3: Quiz Assignment -->
                                    <div class="tab-pane fade" id="step3" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label" for="quiz_id">Select Quiz *</label>
                                            <select id="quiz_id" name="quiz_id" class="form-select @error('quiz_id') is-invalid @enderror" required>
                                                <option value="">Select Quiz</option>
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}" {{ old('quiz_id', $question->quiz_id ?? '') == $quiz->id ? 'selected' : '' }}>
                                                        {{ $quiz->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('quiz_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-label-secondary" onclick="prevStep(2)">Previous</button>
                                            <button type="submit" class="btn btn-primary">{{ isset($question) ? 'Update Question' : 'Create Question' }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

@section('footer-js')
<script>
    let optionIndex = {{ isset($question) && $question->options->count() > 0 ? $question->options->count() : 4 }};

    function nextStep(step) {
        // Validate current step before proceeding
        if (step === 2) {
            if (!$('#question_text').val() || !$('#marks').val()) {
                alert('Please fill in all required fields in Step 1');
                return;
            }
        } else if (step === 3) {
            let hasOptions = false;
            let optionCount = 0;
            let hasCorrect = $('input[name="correct_option"]:checked').length > 0;
            $('.option-row').each(function() {
                let text = $(this).find('input[name*="[text]"]').val();
                if (text && text.trim() !== '') {
                    hasOptions = true;
                    optionCount++;
                }
            });
            if (!hasOptions || optionCount < 2 || !hasCorrect) {
                alert('Please add at least 2 options with text and mark one as correct');
                return;
            }
        }

        // Switch to next step
        $('#step' + (step - 1) + '-tab').removeClass('active');
        $('#step' + step + '-tab').addClass('active');
        $('#step' + (step - 1)).removeClass('show active');
        $('#step' + step).addClass('show active');
    }

    function prevStep(step) {
        $('#step' + (step + 1) + '-tab').removeClass('active');
        $('#step' + step + '-tab').addClass('active');
        $('#step' + (step + 1)).removeClass('show active');
        $('#step' + step).addClass('show active');
    }

    function addOption() {
        let html = `
            <div class="option-row mb-3 border p-3 rounded" data-index="${optionIndex}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Option ${optionIndex + 1}</h6>
                    <button type="button" class="btn btn-sm btn-label-danger" onclick="removeOption(${optionIndex})">Remove</button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Option Text *</label>
                    <input type="text" class="form-control" name="options[${optionIndex}][text]" required />
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input correct-option-radio" type="radio" name="correct_option" value="${optionIndex}" id="correct${optionIndex}" />
                        <label class="form-check-label" for="correct${optionIndex}">Correct Answer</label>
                    </div>
                </div>
            </div>
        `;
        $('#optionsContainer').append(html);
        optionIndex++;
    }

    function removeOption(index) {
        // Check if the removed option was the correct one
        let wasCorrect = $('.option-row[data-index="' + index + '"]').find('input[type="radio"]').is(':checked');
        $('.option-row[data-index="' + index + '"]').remove();
        
        // Reindex remaining options
        let newIndex = 0;
        $('.option-row').each(function() {
            $(this).attr('data-index', newIndex);
            $(this).find('h6').text('Option ' + (newIndex + 1));
            $(this).find('input[name*="[text]"]').attr('name', 'options[' + newIndex + '][text]');
            $(this).find('input[type="radio"]').attr('value', newIndex).attr('id', 'correct' + newIndex);
            $(this).find('label').attr('for', 'correct' + newIndex);
            newIndex++;
        });
        optionIndex = newIndex;
        
        // If the removed option was correct and there are still options, select the first one
        if (wasCorrect && $('.option-row').length > 0) {
            $('.option-row').first().find('input[type="radio"]').prop('checked', true);
        }
    }

    // Prepare form data before submission - convert correct_option to options array format
    function prepareFormData() {
        let correctOptionIndex = $('input[name="correct_option"]:checked').val();
        
        if (!correctOptionIndex) {
            alert('Please select a correct answer');
            return false;
        }
        
        // Add hidden inputs to mark correct option
        $('.option-row').each(function() {
            let index = $(this).attr('data-index');
            let text = $(this).find('input[name*="[text]"]').val();
            if (text && text.trim() !== '') {
                let isCorrect = (index == correctOptionIndex) ? '1' : '0';
                // Remove any existing hidden field
                $(this).find('input[type="hidden"][name*="[is_correct]"]').remove();
                // Add new hidden field
                $(this).append('<input type="hidden" name="options[' + index + '][is_correct]" value="' + isCorrect + '">');
            }
        });
        
        return true;
    }
    
    // Ensure form data is prepared on submit
    $('#questionForm').on('submit', function(e) {
        if (!prepareFormData()) {
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection
