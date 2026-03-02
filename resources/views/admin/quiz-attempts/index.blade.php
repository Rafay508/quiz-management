@extends('admin.layouts.app')

@section('title', 'Quiz Attempts / Results')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="card-info">
                                    <p class="card-text">Total Attempts</p>
                                    <h4 class="card-title mb-0">{{ number_format($stats['total_attempts']) }}</h4>
                                </div>
                                <div class="card-icon">
                                    <span class="badge bg-label-primary rounded p-2">
                                        <i class="ti ti-clipboard-check ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="card-info">
                                    <p class="card-text">Completed</p>
                                    <h4 class="card-title mb-0">{{ number_format($stats['completed_attempts']) }}</h4>
                                </div>
                                <div class="card-icon">
                                    <span class="badge bg-label-success rounded p-2">
                                        <i class="ti ti-check ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="card-info">
                                    <p class="card-text">Passed</p>
                                    <h4 class="card-title mb-0">{{ number_format($stats['passed_count']) }}</h4>
                                </div>
                                <div class="card-icon">
                                    <span class="badge bg-label-success rounded p-2">
                                        <i class="ti ti-circle-check ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="card-info">
                                    <p class="card-text">Failed</p>
                                    <h4 class="card-title mb-0">{{ number_format($stats['failed_count']) }}</h4>
                                </div>
                                <div class="card-icon">
                                    <span class="badge bg-label-danger rounded p-2">
                                        <i class="ti ti-circle-x ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scrollable -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quiz Attempts / Results</h5>
                    <small class="text-muted float-end">
                        <a href="{{ route('admin.quiz-attempts.export', request()->query()) }}" class="btn btn-primary">
                            <i class="ti ti-download ti-sm me-1"></i> Export CSV
                        </a>
                    </small>
                </div>
                
                <!-- Filters and Search -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.quiz-attempts.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Name, Email, or Student ID..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="abandoned" {{ request('status') == 'abandoned' ? 'selected' : '' }}>Abandoned</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pass/Fail</label>
                            <select name="is_passed" class="form-select">
                                <option value="" {{ !request('is_passed') ? 'selected' : '' }}>All</option>
                                <option value="passed" {{ request('is_passed') == 'passed' ? 'selected' : '' }}>Passed</option>
                                <option value="failed" {{ request('is_passed') == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-12 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.quiz-attempts.index') }}" class="btn btn-label-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-datatable text-nowrap">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Attempt ID</th>
                                    <th>Quiz Title</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Student ID</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                    <th>Percentage</th>
                                    <th>Pass/Fail</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attempts as $attempt)
                                    <tr>
                                        <td>{{ $attempt->id }}</td>
                                        <td>{{ $attempt->quiz->title ?? 'N/A' }}</td>
                                        <td>{{ $attempt->name ?? 'N/A' }}</td>
                                        <td>{{ $attempt->email ?? 'N/A' }}</td>
                                        <td>{{ $attempt->student_id ?? 'N/A' }}</td>
                                        <td>
                                            @if($attempt->status == 'completed')
                                                <span class="badge bg-label-success">Completed</span>
                                            @elseif($attempt->status == 'in_progress')
                                                <span class="badge bg-label-warning">In Progress</span>
                                            @else
                                                <span class="badge bg-label-danger">Abandoned</span>
                                            @endif
                                        </td>
                                        <td>{{ $attempt->score ?? '0' }}</td>
                                        <td>{{ $attempt->percentage ? number_format($attempt->percentage, 2) . '%' : '0%' }}</td>
                                        <td>
                                            @if($attempt->status == 'completed')
                                                @if($attempt->is_passed)
                                                    <span class="badge bg-label-success">Pass</span>
                                                @else
                                                    <span class="badge bg-label-danger">Fail</span>
                                                @endif
                                            @else
                                                <span class="badge bg-label-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $attempt->start_time ? $attempt->start_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                        <td>{{ $attempt->end_time ? $attempt->end_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.quiz-attempts.show', $attempt->id) }}" class="btn btn-sm btn-icon">
                                                <i class="ti ti-eye text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">No quiz attempts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="card-body">
                    {{ $attempts->links() }}
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

@endsection
