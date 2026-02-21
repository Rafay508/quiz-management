@extends('admin.layouts.app')

@section('title', 'Question Bank')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Scrollable -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Question Bank</h5>
                    <div class="float-end">
                        <button type="button" class="btn btn-label-secondary me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="ti ti-upload me-1"></i> Import Questions
                        </button>
                        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Question
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.questions.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Quiz</label>
                            <select name="quiz_id" class="form-select">
                                <option value="">All Quizzes</option>
                                @foreach($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}" {{ request('quiz_id') == $quiz->id ? 'selected' : '' }}>
                                        {{ $quiz->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Difficulty Level</label>
                            <select name="difficulty_level" class="form-select">
                                <option value="">All Levels</option>
                                <option value="easy" {{ request('difficulty_level') == 'easy' ? 'selected' : '' }}>Easy</option>
                                <option value="medium" {{ request('difficulty_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="hard" {{ request('difficulty_level') == 'hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Group By</label>
                            <select name="group_by" class="form-select">
                                <option value="">None</option>
                                <option value="quiz" {{ request('group_by') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-label-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-datatable text-nowrap">
                    <table class="dt-scrollableTable table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question Text</th>
                                <th>Quiz</th>
                                <th>Marks</th>
                                <th>Difficulty</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(request('group_by') == 'quiz' && $questions instanceof \Illuminate\Support\Collection && $questions->first() instanceof \Illuminate\Support\Collection)
                                @foreach($questions as $quizId => $quizQuestions)
                                    <tr class="table-info">
                                        <td colspan="7"><strong>Quiz: {{ $quizQuestions->first()->quiz->title ?? 'N/A' }}</strong></td>
                                    </tr>
                                    @foreach($quizQuestions as $question)
                                        @include('admin.questions.partials.question-row', ['question' => $question])
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($questions as $question)
                                    @include('admin.questions.partials.question-row', ['question' => $question])
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Scrollable -->
        </div>
        <!-- / Content -->
        @include('admin.layouts.partials.footer')
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Import Questions</h3>
                    <p class="text-muted">Upload a CSV file to import questions</p>
                </div>
                <form method="POST" action="{{ route('admin.questions.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Download Template</label>
                        <div>
                            <a href="{{ route('admin.questions.download-template') }}" class="btn btn-label-secondary">
                                <i class="ti ti-download me-1"></i> Download CSV Template
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File *</label>
                        <input type="file" name="import_file" class="form-control" accept=".csv,.txt" required>
                        <small class="text-muted">Only CSV files are supported</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Import</button>
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer-js')
<script>
    // Quick edit functionality
    function enableQuickEdit(id) {
        var row = $('#questionRow' + id);
        var questionText = row.find('.question-text').text();
        var marks = row.find('.question-marks').text();
        
        row.find('.question-text').html('<input type="text" class="form-control form-control-sm" value="' + questionText + '" id="editText' + id + '">');
        row.find('.question-marks').html('<input type="number" class="form-control form-control-sm" value="' + marks + '" id="editMarks' + id + '" min="0">');
        row.find('.quick-edit-btn').html('<button class="btn btn-sm btn-success" onclick="saveQuickEdit(' + id + ')">Save</button> <button class="btn btn-sm btn-label-secondary" onclick="cancelQuickEdit(' + id + ')">Cancel</button>');
    }
    
    function saveQuickEdit(id) {
        var data = {
            question_text: $('#editText' + id).val(),
            marks: $('#editMarks' + id).val(),
            _token: '{{ csrf_token() }}',
            _method: 'PUT'
        };
        
        $.ajax({
            url: '{{ url("admin/questions") }}/' + id + '/quick-update',
            type: 'POST',
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert('Failed to update question');
            }
        });
    }
    
    function cancelQuickEdit(id) {
        location.reload();
    }
</script>
@endsection
