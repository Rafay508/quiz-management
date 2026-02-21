@extends('admin.layouts.app')

@section('title', isset($quiz) ? 'Edit Quiz' : 'Create Quiz')
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
                            <h5 class="mb-0">{{ isset($quiz) ? 'Edit Quiz' : 'Create Quiz' }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ isset($quiz) ? route('admin.quizzes.update', $quiz->id) : route('admin.quizzes.store') }}" class="number-tab-steps wizard-circle">
                                @csrf
                                @if(isset($quiz))
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label class="form-label" for="title">Quiz Title *</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-file-text"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            name="title"
                                            value="{{ old('title', $quiz->title ?? '') }}"
                                            required />
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="category_id">Category *</label>
                                    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $quiz->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="description"
                                        name="description"
                                        rows="3">{{ old('description', $quiz->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="duration_minutes">Duration (minutes) *</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ti ti-clock"></i></span>
                                            <input
                                                type="number"
                                                class="form-control @error('duration_minutes') is-invalid @enderror"
                                                id="duration_minutes"
                                                name="duration_minutes"
                                                value="{{ old('duration_minutes', $quiz->duration_minutes ?? '') }}"
                                                min="1"
                                                required />
                                        </div>
                                        @error('duration_minutes')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="total_marks">Total Marks *</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ti ti-star"></i></span>
                                            <input
                                                type="number"
                                                class="form-control @error('total_marks') is-invalid @enderror"
                                                id="total_marks"
                                                name="total_marks"
                                                value="{{ old('total_marks', $quiz->total_marks ?? '') }}"
                                                min="0"
                                                required />
                                        </div>
                                        @error('total_marks')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="pass_marks">Passing Marks *</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ti ti-check"></i></span>
                                            <input
                                                type="number"
                                                class="form-control @error('pass_marks') is-invalid @enderror"
                                                id="pass_marks"
                                                name="pass_marks"
                                                value="{{ old('pass_marks', $quiz->pass_marks ?? '') }}"
                                                min="0"
                                                required />
                                        </div>
                                        @error('pass_marks')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="expiry_date">Expiry Date</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                        <input
                                            type="datetime-local"
                                            class="form-control @error('expiry_date') is-invalid @enderror"
                                            id="expiry_date"
                                            name="expiry_date"
                                            value="{{ old('expiry_date', isset($quiz->expiry_date) ? $quiz->expiry_date->format('Y-m-d\TH:i') : '') }}" />
                                    </div>
                                    @error('expiry_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="instructions">Instructions</label>
                                    <textarea
                                        class="form-control @error('instructions') is-invalid @enderror"
                                        id="instructions"
                                        name="instructions"
                                        rows="4">{{ old('instructions', $quiz->instructions ?? '') }}</textarea>
                                    @error('instructions')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status">Status *</label>
                                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="draft" {{ old('status', $quiz->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $quiz->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status', $quiz->status ?? '') == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quiz Settings -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quiz Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="random_questions_count">Random Questions Count</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="ti ti-shuffle"></i></span>
                                                <input
                                                    type="number"
                                                    class="form-control @error('random_questions_count') is-invalid @enderror"
                                                    id="random_questions_count"
                                                    name="random_questions_count"
                                                    value="{{ old('random_questions_count', $quiz->random_questions_count ?? '') }}"
                                                    min="1"
                                                    placeholder="Leave empty to show all questions" />
                                            </div>
                                            @error('random_questions_count')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave empty (null) to show all questions. Set a number to show only that many random questions per attempt.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">{{ isset($quiz) ? 'Update Quiz' : 'Create Quiz' }}</button>
                                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-label-secondary">Cancel</a>
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
    // Validate pass_marks <= total_marks
    $('#total_marks, #pass_marks').on('blur', function() {
        var totalMarks = parseInt($('#total_marks').val()) || 0;
        var passMarks = parseInt($('#pass_marks').val()) || 0;
        
        if (passMarks > totalMarks) {
            alert('Passing marks cannot be greater than total marks.');
            $('#pass_marks').val(totalMarks);
        }
    });
</script>
@endsection
