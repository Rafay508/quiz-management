@extends('admin.layouts.app')

@section('title', 'Category Reports')
@section('content')
<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            @if(isset($category))
                <!-- Single Category Report -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Category Report: {!! $category->name !!}</h5>
                                <a href="{!! route('admin.categories.index') !!}" class="btn btn-label-secondary">Back to Categories</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="card bg-label-primary">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Quizzes</h6>
                                                <h3 class="mb-0">{!! $totalQuizzes !!}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card bg-label-success">
                                            <div class="card-body">
                                                <h6 class="card-title">Published Quizzes</h6>
                                                <h3 class="mb-0">{!! $publishedQuizzes !!}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card bg-label-warning">
                                            <div class="card-body">
                                                <h6 class="card-title">Draft Quizzes</h6>
                                                <h3 class="mb-0">{!! $draftQuizzes !!}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card bg-label-info">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Attempts</h6>
                                                <h3 class="mb-0">{!! $totalAttempts !!}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quizzes in this Category</h5>
                    </div>
                    <div class="card-datatable text-nowrap">
                        <table class="dt-scrollableTable table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Published</th>
                                    <th>Total Attempts</th>
                                    <th>Total Marks</th>
                                    <th>Pass Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quizzes as $quiz)
                                    <tr>
                                        <td>{!! $quiz->title !!}</td>
                                        <td>
                                            @if($quiz->status == 'published')
                                                <span class="badge bg-label-success">Published</span>
                                            @elseif($quiz->status == 'draft')
                                                <span class="badge bg-label-warning">Draft</span>
                                            @else
                                                <span class="badge bg-label-secondary">Archived</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($quiz->is_published)
                                                <span class="badge bg-label-success">Yes</span>
                                            @else
                                                <span class="badge bg-label-warning">No</span>
                                            @endif
                                        </td>
                                        <td>{!! $quiz->quiz_attempts_count !!}</td>
                                        <td>{!! $quiz->total_marks !!}</td>
                                        <td>{!! $quiz->pass_marks !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No quizzes found in this category.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- All Categories Report -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Categories Report</h5>
                        <a href="{!! route('admin.categories.index') !!}" class="btn btn-label-secondary">Back to Categories</a>
                    </div>
                    <div class="card-datatable text-nowrap">
                        <table class="dt-scrollableTable table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Total Quizzes</th>
                                    <th>Published Quizzes</th>
                                    <th>Draft Quizzes</th>
                                    <th>Total Attempts</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categoryStats as $stat)
                                    <tr>
                                        <td>{!! $stat['category']->name !!}</td>
                                        <td>
                                            @if($stat['category']->status == 'active')
                                                <span class="badge bg-label-success">Active</span>
                                            @else
                                                <span class="badge bg-label-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{!! $stat['total_quizzes'] !!}</td>
                                        <td>{!! $stat['published_quizzes'] !!}</td>
                                        <td>{!! $stat['draft_quizzes'] !!}</td>
                                        <td>{!! $stat['total_attempts'] !!}</td>
                                        <td>
                                            <a href="{!! route('admin.categories.reports', $stat['category']->id) !!}" class="btn btn-sm btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <!-- / Content -->
        @include('admin.layouts.partials.footer')
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>

@endsection
